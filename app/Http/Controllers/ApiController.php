<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function apiResponse($status, $msg, $data = null)
    {
        $response = [
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($response);
    }
    public function register(Request $request){
        $validator = validator()->make($request->all(),[
            'name'=>'required',
            'password'=>'required|confirmed',
            'email'=>'required|unique:users',
        ]);
        
        if($validator->fails())
            return apiResponse(0,'validation error',$validator->errors());

        $request->merge(['password'=>bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token=str_random(60);
        $client->save();
        return apiResponse(1,'success',[
            'api_token'=>$client->api_token,
            'client'=>$client
        ]);
    }

    public function login(Request $request){
        $validator = validator()->make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails())
            return this.apiResponse(0,'invalid credentials',$validator->errors());
        
        $user = User::where('email',$request->email)->first();
        if($user){
            if (Hash::make($request->password, [$user->password])) {
                $user->api_token=str_random(60);
                
                return $this->this.apiResponse(1, 'success', [
                    'api_token'=>$user->api_token,
                    'user'=>$user
                ]);
            }
            else
                return this.apiResponse(0,'invalid creds');
        }
        else 
            return this.apiResponse(0,'invalid creds');
    }

    public function registerToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
            'platform' => 'required|in:android,ios'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return this.apiResponse(0,$validation->errors()->first(),$data);
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        $data = [
            'status' => 1,
            'msg' => 'Registered successfully',
        ];
        return response()->json($data);
    }

    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return this.apiResponse(0,$validation->errors()->first(),$data);
        }
        Token::where('token',$request->token)->delete();
        $data = [
            'status' => 1,
            'msg' => 'Removed successfully',
        ];
        return response()->json($data);
    }

    public function reset(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'email' => 'required'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return this.apiResponse(0,$validation->errors()->first(),$data);
        }
        $user = User::where('email',$request->email)->first();
        if ($user){
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if ($update)
            {
                // send email
                //  Mail::send('emails.reset', ['code' => $code], function ($mail) use($user) {
                //  $mail->from('app.mailing.test@gmail.com', 'Blood Bank');
                //  $mail->to($user->email, $user->name)->subject('reset subject');
                // });
                return this.apiResponse(1,'check your email',['pin_code_for_test' => $code]);
            }else{
                return this.apiResponse(0,'error, try again');
            }
        }else{
            return this.apiResponse(0,'email number not found ');
        }
    }
    
    
    public function password(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'confirmed'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return this.apiResponse(0,$validation->errors()->first(),$data);
        }
        $user = User::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();
        if ($user)
        {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if ($user->save())
            {
                return this.apiResponse(1,'password changed successfully');
            }else{
                return this.apiResponse(0,'error, try again');
            }
        }else{
            return this.apiResponse(0,'invalid code');
        }
    }
}
