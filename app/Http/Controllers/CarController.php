<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
//use Auth;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {   
        $cars = Car::where('user_id', Auth::user()->id)->get();
        return view('car.allcars')->with('cars', $cars);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $car = new Car;
        $car->license = $request->license;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->numSeats = $request->numSeats;
        $car->kind = $request->kind;
        $car->user_id = Auth::user()->id;

        //$car->user_id = Auth::user->id;
        $car->save();
        return view('car.show') -> with ('car', $car);
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
        return view('car.show')->with('car', $car);
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
        return view('car/edit')->with('car', $car);
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
        $this->validator($request->all())->validate();

        $car = Car::find($id);

        $car->license = $request->license;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->numSeats = $request->numSeats;
        $car->kind = $request->kind;
        
        $car->save();
        $car = Car::find($id);
        return view('car.shownewcar')->with('car', $car)->with('success', 'Vehiculo editado');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $car = Car::find($id);
        $car->delete();         //hay que verificar que no haya viajes pendientes

        return view('car.show')->with('cars', $cars)->with('success', 'Vehiculo eliminado'); //redirecciona a cualquier lugar
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
