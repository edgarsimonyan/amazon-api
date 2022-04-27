<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if ($user->isAdmin()) {
            Session::put('isAdmin', $user);
            return redirect()->route('admin.index');
        }
        else if ($user->isCustomer()) {
            Session::put('user', $user);
        }
        $products = Product::all();

        return view('welcome',compact('products'));
    }
}
