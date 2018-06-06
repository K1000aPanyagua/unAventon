<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::where('user_id', Auth::user()->id)->get();
        return view('card.allCards')->with('cards', $cards);
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
        $this->validator($request->all())->validate();

        //Almacenamiento
        $card = new Card;
        $card->numCard = $request->numCard;
        $card->expiration = $request->expiration;
        $card->user_id = Auth::user()->id;

        $card->save();

        //Redireccion
        return view('card.show')->with('card', $card);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::find($id);
        return view('card.show')->compact('$cards');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('card.edit');
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
        $this->validator($request->all())->validate();
        //Almacenamiento
        $card->numCard = $request->numCard;
        $card->expiration = $request->expiration;
        $card->user_id = Auth::User()->id;

        $card->save();

        //Redireccion
        return view('card.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Se elimina la tarjeta con id $id
        Card::destroy($id);
        
        //Se redirecciona a la vista de tarjetas
        return view('card.allcards');
    }

    protected function validator(array $data){
        
        return Validator::make($data, [
            'license' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'string',
            'numSeats' => 'integer|required',
        ]);
    }

}
