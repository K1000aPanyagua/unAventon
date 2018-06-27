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
        if ($id != Auth::user()->id) {
            return view('user.showOtherUser');
        }

        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function editPassword(){

        return view('user/passForm');
     if ($id != Auth::user()->id) {
            return view('/');
        }

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


    protected function updateValidator(array $data){
        
        return Validator::make($data, [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
        ]);
    }

    protected function passValidator(array $data){
        return  Validator::make($data, [
            'nuevaContraseña' => 'string|required|min:6'
            ]);
    }

   
    public function update(Request $request, $id){
        if ($id != Auth::user()->id) {
            return view('/');
        }

        $this->updateValidator($request->all())->validate();
        $user = User::find($id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->gender = $request->gender;
        $user->telephone = $request->telephone;
        $user->save();

        //Redireccion
        return view('user.show')->with('user', $user)->with('success', 'Cambios guardados');
    }

    public function destroy($id){   
        if ($id != Auth::user()->id) {
            return view('/');
        }

        User::destroy($id);
        return redirect('/')->with('success', 'Usuario eliminado');
    }

    public function updatePassword(Request $request){
        $this->passValidator($request->all())->validate();
        $passw = $request->input('pass');
        
        if (\Hash::check($passw, Auth::user()->pass)){
            Auth::user()->pass = bcrypt($request->input('nuevaContraseña'));
            Auth::user()->save();
        return redirect('/editPass')->with('user', Auth::user()->email)->with('success', 'Cambios guardados');
        }
        else{
            return redirect('/editPass')->with('user', Auth::user()->email)->with('error', 'Contraseña actual incorrecta');
        }
    }

}


   /*  if ($id != Auth::user()->id) {
            return view('/');
        }

        $passw = $request->input('pass');
        $nuevaContraseña = $request->input('nuevaContraseña');
        return  Validator::make($request, ['pass' => 'string|required|min:6']);