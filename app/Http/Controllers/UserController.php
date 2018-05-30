<?php

namespace App\Http\Controllers;


use Validator;
use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    

    public function store(Request $request)
    {
<<<<<<< HEAD
=======

<<<<<<< HEAD
=======
>>>>>>> 6f51cdc1843b9d735563aab0fc6a1b832ad67794
    
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564
        //Validation
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
            'telephone' => 'string',
        
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } 

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

<<<<<<< HEAD
=======
<<<<<<< HEAD

        return view('search');
}
=======
        


>>>>>>> 6f51cdc1843b9d735563aab0fc6a1b832ad67794
        return view('search');
    }
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        //
=======
        //Carga vista de editar perfil
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        //
=======
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
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        //
    }
}
=======
        Item::find(1)->delete();
        return view('home')->with([
            'flash_message' => 'Usuario eliminado',
            'flash_message_important' => false
            ]);
    }
}
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564
