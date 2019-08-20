<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){

        $credentials = $request->only(['username', 'password']);
  
        if (!$token = JWTAuth::attempt($credentials)) {
           //return 'Invalid login details';
           return redirect()->back()->with('message', 'Invalid login details');
        }
  
        // return response()->json([
        //     'token' => $token,
        //     'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
            
        // ]);

        return redirect('/')->with(['success' => 'Logged in', 'token' => $token, 'expires' => auth('api')->factory()->getTTL() * 60]);

     }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
    
}
