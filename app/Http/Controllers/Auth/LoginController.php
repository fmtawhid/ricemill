<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/customer/dashboard';
    // protected function redirectTo()
    // {
    //     if (Auth::user()->isAdmin()) {
    //         return '/panel/{user_id}/dashboard';
    //     } elseif (Auth::user()->isCustomer()) {
    //         return '/panel/{user_id}/dashboard';
    //     }

    //     return '/panel/{user_id}/dashboard';
    // }
    protected function redirectTo()
    {
        $userId = Auth::user()->id; // Get logged-in user's ID

        if (Auth::user()->isAdmin()) {
            return "/panel/{$userId}/dashboard";
        } elseif (Auth::user()->isCustomer()) {
            return "/panel/{$userId}/dashboard";
        }

        return "/panel/{$userId}/dashboard";
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}