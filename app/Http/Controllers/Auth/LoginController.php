<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        
        $email = $request->input('email');
        $pass = $request->input('pass');
        $data = [ 'email' => $email,
            'pass' => $pass];
        
        $user = User::onlyTrashed()->where('email', $email)->first();
        if ( $user != null ){
                return redirect()->back()->with('deleted', 'Su cuenta ha sido desactivada, ¿Desea recuperarla?');
            }
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/')->with('success', 'Bienvenido');
        }else{
            return redirect()->back()->with('error', 'Lo sentimos.. el E-mail o la contraseña no son correctos.');
        }
    }

    public function getLogin(){
        return view('auth/login');
    }

    public function getLogInDeleted(){
        return view('auth/loginDeleted');
    }

    public function logOut(){
        Auth::logout();
        Session::flush();
        return redirect()->intended('/');
    }

    public function recoverAccount(Request $request){
        $email = $request->input('email');
        $user = User::onlyTrashed()->where('email', $email)->first();
        $user->restore();
        $credentials = $this->validator($request->all())->validate();
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/')->with('success', 'Bienvenido');
        }else{
            return redirect()->back()->with('error', 'Lo sentimos.. el E-mail o la contraseña no son correctos.');
        }
    }

}
