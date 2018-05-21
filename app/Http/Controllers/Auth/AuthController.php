<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel as Product;
use App\BidModel;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function __construct()
{
    $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
}
	public function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }
}
