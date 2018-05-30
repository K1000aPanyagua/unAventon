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

<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> 6f51cdc1843b9d735563aab0fc6a1b832ad67794
    
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564
>>>>>>> 9b89a1b728adb0a7669aeaee9c92e1642b5c81c9
>>>>>>> 1052de727f2b09086311c4a07bb343fc195c51a3
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

<<<<<<< HEAD
=======
<<<<<<< HEAD

        return view('search');
}
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD

        return view('search');
}
=======
        
>>>>>>> 1052de727f2b09086311c4a07bb343fc195c51a3


        return view('search');
    }
<<<<<<< HEAD

   
=======
>>>>>>> 5f4d9c3aef79b3efac66f84d6cbe5759fe1d7564
>>>>>>> 9b89a1b728adb0a7669aeaee9c92e1642b5c81c9

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
>>>>>>> 1052de727f2b09086311c4a07bb343fc195c51a3
    public function show($id)
    {
        $user=User::find($id);
        return view('user.show', compact('user'));
    }

  
    public function edit($id)
    {
<<<<<<< HEAD

        //Carga vista de editar perfil

=======
        //
>>>>>>> 1052de727f2b09086311c4a07bb343fc195c51a3
    }

    
    public function update(Request $request, $id)
    {
<<<<<<< HEAD

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

=======
        //
>>>>>>> 1052de727f2b09086311c4a07bb343fc195c51a3
    }

   
    public function destroy($id)
    {
<<<<<<< HEAD
        Item::find(1)->delete();
        return view('home')->with([
            'flash_message' => 'Usuario eliminado',
            'flash_message_important' => false
            ]);
    }
}

        


=======
        //
    }
}
>>>>>>> 1052de727f2b09086311c4a07bb343fc195c51a3
