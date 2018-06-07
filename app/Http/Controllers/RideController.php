<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rides= Ride::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ride.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'origin' => 'required|varchar',
            'destination' => 'required|varchar',
            'duration' => 'required|time',
            'amount' => 'required|decimal',
            'remarks' => 'varchar',
            'departDate' => 'date',
            'departHour' => 'time',
            ]);


        $ride = new Ride;
        $ride->user_id =        Auth::User()->id;
        //$ride->car_id =         $request->car_id;
        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        //$ride->account_id =     $request->account_id;
        //$ride->card_id =        $request->card_id;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        $ride->save();
        

        return view('ride.show');
        
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
