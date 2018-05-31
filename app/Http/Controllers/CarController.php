<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
//use Auth;
use App\User;
use Illuminate\Support\Facades\Auth; 

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
<<<<<<< HEAD
    {
        $cars = Car::All();
=======
    {   
       
        $cars = Car::where('user_id', Auth::user()->id)->get();
>>>>>>> 586aaa6dea18162f9f3b3e38183e404cf8b70aa5
        return view('car/allcars')->with('cars', $cars);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = new Car;
        $car->license = $request->license;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->numSeats = $request->numSeats;
        $car->kind = $request->kind;
<<<<<<< HEAD
<<<<<<< HEAD
        $car->user_id = '1';
=======
<<<<<<< HEAD
=======
>>>>>>> 586aaa6dea18162f9f3b3e38183e404cf8b70aa5
        $car->user_id = Auth::user()->id;

<<<<<<< HEAD
>>>>>>> 3500a9d6b9fd85a0b4815a619fd4dd60dcb2dbf0
=======
        //$car->user_id = Auth::user->id;
>>>>>>> 586aaa6dea18162f9f3b3e38183e404cf8b70aa5
        $car->save();
        return view('car/shownewcar') -> with ('car' , $car);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('car/edit', compact('car'));
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
        $car->license = $request->license;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->numSeats = $request->numSeats;
        $car->kind = $request->kind;
        
        $car->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return view('home')->with([
            'flash_message' => 'Vehiculo eliminado',
            'flash_message_important' => false
            ]);
    }
}
