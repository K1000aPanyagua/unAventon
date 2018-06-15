<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;
use Auth;
use App\Card;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $rides= Ride::all(); //RIDE INDEX DEBERIA LLAMARSE CON UN INCLUDE EN EL HOME
        return view('ride.index')->with('rides', $rides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //VERIFICAR QUE USUARIO TENGA TARJETA Y ESTÉ AUNTENTICADO
        if (!Auth::check()) {
            return redirect('/register')->with('error','Registrate para publicar tu viaje!');
        }
        $id = Auth::user()->id;
        $cards = Card::where('user_id', $id)->get();
        if ( $cards == null) {
            return redirect('card/create')->with('error', 'Usted no posee tarjeta asignada, ingrese una.');
        }
        return view('ride.create')->with('cards', $cards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data){
        
        return Validator::make($data, [
            'origin' => 'required|varchar',
            'destination' => 'required|varchar',
            'duration' => 'required|time',
            'amount' => 'required|decimal',
            'remarks' => 'varchar',
            'departDate' => 'date|required',
            'departHour' => 'time|required',
        ]);
    }

    public function store(Request $request)
    {
        $this->Validator($request->all())->validate();

        $ride = new Ride;
        $ride->user_id =        Auth::User()->id;
        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        //$ride->account_id =     Account::where('user_id', Auth::User()->id);
        $ride->card_id =        $request->idCard;
        $ride->save();
        

        return view('ride.show')->with('ride', $ride);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ride = Ride::find($id);
        return view('ride.show')->with('ride', $ride);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //CONTROLAR QUE NO HAYA COPILOTOS PENDIENTES O ACEPTADOS
        $ride = Ride::find($id);
        return view('ride.show')->with('ride', $ride);
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
        //SI SE LLEGA ACÁ ES POR QUE NO HAY COPILOTOS ASOCIADOS
        $this->validator($request->all())->validate();

        $ride = ride::find($id);

        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        //$ride->account_id =     Account::where('user_id', Auth::User()->id);
        $ride->card_id =        $request->idCard;
        
        $ride->save();
        $ride = ride::find($id);
        return view('ride.show')->with('ride', $ride)->with('success', 'Viaje editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Se elimina el auto con id $id
        //CONTROLAR QUE NO HAYA COPILOTOS PENDIENTES O ACEPTADOS, EN CASO DE HABER PEDIR CONFIRMACION DE DELETE ,ADVERTIR DE PENALIZACIÓN Y APLICARLA
        Ride::destroy($id);
        $rides = Ride::where('user_id', Auth::user()->id)->get();
        //redirecciona a cualquier lugar
        return view('ride.allrides')->with('rides', $rides)->with('warning', 'viaje eliminado');
    }
}
