<?php

namespace App\Http\Controllers\GiangvienAuth;

use Illuminate\Http\Request;  
use App\Http\Controllers\Controller;  
use Illuminate\Foundation\Auth\AuthenticatesUsers;  
use Illuminate\Support\Facades\Auth;

class GiangvienAuthController extends Controller  
{
    use AuthenticatesUsers;

    protected $redirectTo = '/giangvien/dashboard/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('giangvien_guest', ['except' => 'logout']);
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
            'email' => 'required|email|max:190|unique:giangvien',
            'password' => 'required|confirmed|min:8',
        ]);
    }

    public function showLoginForm()
    {
        return view('auth_giangvien.login');
    }

    protected function guard()
    {
      return Auth::guard('giangvien');
    }

    // public function username()
    // {
    //     return 'username';
    // }

    // Hàm
    // protected function hasTooManyLoginAttempts(Request $request)
    // {
    //     return $this->limiter()->tooManyAttempts(
    //         $this->throttleKey($request), 3, 30
    //     );
    // }

    public function maxAttempts()
    {
        return 3;
    }

    public function decayMinutes()
    {
        return 30;
    }

}