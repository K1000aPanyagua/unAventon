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

  
    public function edit($id){

        //Carga vista de editar perfil

        $user=User::find($id);
        return view('user.edit', compact('user'));
    }

    
    public function update(Request $request, $id)
    {

        $this->validator($request->all())->validate();

        $user = User::find($id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->pass = $request->pass;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->telephone = $request->telephone;
        $user->save();

        //Redireccion
        return view('user.edit', compact('user'))->with('success', 'Usuario eliminado');


    }

   
    public function destroy($id)
    {   
        
        
        User::destroy($id);

        return view('home')->with('success', 'Usuario eliminado');
    }
}


