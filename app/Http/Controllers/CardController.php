<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $card = Card::where('user_id', '$user_id');
        return view('card.index', compact('card'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Validacion


        //Almacenamiento
        $card = new Card;
        $card->numCard          = $request->numCard;
        $card->expiration       = $request->expiration;
<<<<<<< HEAD
        //$card->user_id          = Auth::(User)->id;
=======
        $card->user_id          = Auth::User()->id;
>>>>>>> e73739c32784ca2d6189c1fa8836d205c7166033
        $card->save();

        //Redireccion
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //Validacion


        //Almacenamiento
        $card->numCard          = $request->numCard;
        $card->expiration       = $request->expiration;
<<<<<<< HEAD
        //$card->user_id          = Auth::(User)->id;
=======
        $card->user_id          = Auth::User()->id;
>>>>>>> e73739c32784ca2d6189c1fa8836d205c7166033
        $card->save();

        //Redireccion
        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();
        return view('home');
    }
}
