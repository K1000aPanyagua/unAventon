<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;

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
        $this->middleware('guest')->except('logOut');
    }
    
    protected function validator(array $data){
        
        return Validator::make($data, [
            'pass' => 'required|string',
            'email' => 'required|email', 
        ]);
    }


    public function postLogin(Request $request){   
        $credentials = $this->validator($request->all())->validate();

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            
            return redirect()->intended('/')->with('success', 'Bienvenido');
        }else{
            return redirect()->back()->with('error', 'Email o contraseña erronea');

        }
    }

    
    public function getLogin(){
        return view('auth/login');
    }

    /*protected function guard()
    {
       return Auth::guard('guard-name');
    }
    */

    public function logOut(){
        Auth::logout();
        Session::flush();
        return redirect()->intended('/');
    }

}
