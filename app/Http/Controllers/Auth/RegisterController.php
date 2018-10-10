<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use App\Account;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additio nal code.
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
    public function __construct()
    {
        $this->middleware('guest');
    }
    
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
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
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
            'password' => bcrypt($data['password']),
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

        $fecha = Carbon::parse($request->birthdate);
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;

        $age = Carbon::createFromDate($afecha,$mfecha,$dfecha)->age;
    

        if($age < 18){
            return redirect()->back()->with('error', 'Lo sentimos... debes tener mas de 18 años para registrarte');
        }

        $this->guard()->login($this->create($request->all()));
        
        return redirect('/');
    }

    public function getRegister(){
        return view('auth/register');
    }

    /*protected function guard()
    {
        return Auth::guard('guard-name');
    }*/


}