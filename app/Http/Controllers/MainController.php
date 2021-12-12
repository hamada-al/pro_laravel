<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;

class MainController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function apiResponse($status, $msg, $data = null)
    {
        $response = [
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($response);
    }
    public function listProducts(Request $request)
    {
        $records = Product::all();
        // return $this->apiResponse(200,'ok',$records);
        //return Product::paginate(15);
        return view('product.list',compact('records'));
    }
}
