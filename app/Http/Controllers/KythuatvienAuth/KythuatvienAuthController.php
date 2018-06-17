<?php

namespace App\Http\Controllers\KythuatvienAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class KythuatvienAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/kythuatvien/home/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('kythuatvien_guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:190',
            'email' => 'required|email|max:190|unique:kythuatvien',
            'password' => 'required|confirmed|min:8',
        ]);
    }

    public function showLoginForm()
    {
        return view('auth_kythuatvien.login');
    }

    protected function guard()
    {
      return Auth::guard('kythuatvien');
    }

}