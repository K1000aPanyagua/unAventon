<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\User;

class UserController extends Controller
{
  
    /*public function __construct()
    {
        $this->middleware('guest');
    }
    */
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function editPassword(){
        return view('user.passForm');
    }
    
    public function edit($id){

        //Carga vista de editar perfil

        $user=User::find($id);
        return view('user.edit')->with('user', $user);
    }

    protected function validator(array $data){
        
        return Validator::make($data, [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users',
        ]);
    }

    public function update(Request $request)
    {
        $this->validator($request->all())->validate();
        $email = $request->input('email');
        $user = User::find($email);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->gender = $request->gender;
        $user->telephone = $request->telephone;
        $user->save();

        //Redireccion
        return view('user.show', compact('user'))->with('success', 'Cambios guardados');
    }

    public function destroy($id){   
        User::destroy($id);
        return redirect('/')->with('success', 'Usuario eliminado');
    }

    public function updatePassword(Request $request){
        $passw = $request->input('pass');
        $newPass = $request->input('newPass');
        return  Validator::make($request, ['pass' => 'string|required|min:6']);
        if ($passw == Auth::user()->pass) {
            $user = User::find($email);
            $user->pass = bcrypt($request->input('pass'));
            $user->save();
        }
    }

}


