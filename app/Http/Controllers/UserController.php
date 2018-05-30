<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
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


    public function store(Request $request)
    {


        //Validation
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'password' => 'required|string|confirmed',
            'email' => 'required|email|unique:users',
            'telephone' => 'string',
        
        ]);


        //Almacenamiento
        $user = new User;
        $user->name             = $request->name;
        $user->lastname         = $request->lastname;
        $user->birthdate        = $request->birthdate;
        $user->pass             = $request->pass;
        $user->email            = $request->email;
        $user->gender           = $request->gender;
        $user->telephone        = $request->telephone;
        $user->save();

        //Redireccion



        return view('search');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user=User::find($id);
        return view('user.show', compact('user'));
    }

  
    public function edit($id)
    {


        //Carga vista de editar perfil
<<<<<<< HEAD
        $user=User::find($id);
        return view('user.edit', compact('user'));
=======

>>>>>>> e73739c32784ca2d6189c1fa8836d205c7166033
    }

    
    public function update(Request $request, $id)
    {


        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->pass = $request->pass;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->telephone = $request->telephone;
        $user->save();

        //Redireccion
        return view('home');


    }

   
    public function destroy($id)
    {

        Item::find(1)->delete();
        return view('home')->with([
            'flash_message' => 'Usuario eliminado',
            'flash_message_important' => false
            ]);
    }
}


