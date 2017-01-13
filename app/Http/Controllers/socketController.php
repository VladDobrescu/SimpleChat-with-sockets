<?php

namespace App\Http\Controllers;

use Request;
use LRedis;
use App\User;
use App\Socket;

class socketController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::all();


        return view('home', compact('users'));
    }

    public function send(){
        $redis = LRedis::connection();
        $data = ['message' => Request::input('message'), 'user' => Request::input('user')];
        $redis->publish('message', json_encode($data));
        return response()->json([]);
    }

}
