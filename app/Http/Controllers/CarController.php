<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{

    public function index(){   
        $cars = Car::where('user_id', Auth::user()->id)->get();
        return view('car.allcars')->with('cars', $cars);
    }

    public function create(){
        return view('car.create');
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();

        $car = new Car;
        $car->license = $request->license;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->numSeats = $request->numSeats;
        $car->kind = $request->kind;

        $car->user_id = Auth::user()->id;
        $car->save();
        return view('car.show') -> with ('car', $car);
    }

    public function show($id){
        $car = Car::find($id);
        return view('car.show')->with('car', $car);
    }

    public function edit($id){
        $car = Car::find($id);
        return view('car/edit')->with('car', $car);
    }


    public function update(Request $request, $id){
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
    

    public function destroy($id){
        echo "adasdsad";
        $car = Car::find($id);
        $car->delete();         //hay que verificar que no haya viajes pendientes
        return view('car.allcars')->with('cars', $cars)->with('success', 'Vehiculo eliminado'); //redirecciona a cualquier lugar
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
