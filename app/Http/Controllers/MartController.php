<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class MartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::where('type','1')->get();
        return view('mart.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = 0;
        return view('user.create',compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'type' => 'required',
            'name' => 'required',
            'password'=>['required','string','min:4',],
            'email'=>['email', 'max:255', 'unique:users'],
        ]);

        $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
        $p = new User;
        $p->name= $request->input('name');
        $p->email= $request->input('email');
        $p->type= $request->input('type');
        $p->password= Hash::make($request->input('password'));
        $p->image= $imageName;
        $p->save();
        request()->image->move(public_path('images'), $imageName);
        return redirect(route('user.index')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findorfail($id);
        $edit = 1;
        return view('user.edit',compact('model','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = User::findorfail($id);
        $record->update($request->all());
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findorfail($id);
        $record->delete();
        return back();
    }
}
