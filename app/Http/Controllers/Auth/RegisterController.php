<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('guest');
    }
    */
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        
        return Validator::make($data, [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'pass' => 'min:6|required_with:password-confirm',
            'password-confirm' => 'min:6',
            'email' => 'required|email|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'pass' => bcrypt($data['pass']),
            'lastname' => $data['lastname'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender'],
            'telephone' => $data['telephone']
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->guard()->login($this->create($request->all()));

        return redirect('/')->with('success', 'Usuario creado!');
    }

    public function getRegister(){
        return view('auth/register');
    }

    /*protected function guard()
    {
        return Auth::guard('guard-name');
    }*/

}