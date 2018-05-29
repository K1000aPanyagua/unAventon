<?php

namespace App\Http\Controllers;

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
    
        //Validation
        /*$request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'password' => 'required|string',
            'email' => 'required|email',
            'gender' => 'string',
            'telephone' => 'string',
        ]);*/

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
        
=======
        return view('search');
>>>>>>> d2f6026d94502eec8bd7373aaec50d7fd54dce90
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
