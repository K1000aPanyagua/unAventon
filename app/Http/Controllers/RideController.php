<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;
use Auth;
use App\Card;
use App\Comment;
use Illuminate\Support\Facades\Validator;
use App\Account;
use App\Car;
use App\PassengerRide;
use DB;
use App\User;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$rides= Ride::all(); //RIDE INDEX DEBERIA LLAMARSE CON UN INCLUDE EN EL HOME
        //return view('ride.index')->with('rides', $rides);
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
        if ( count($cards) == 0) {
            return redirect('card/create')->with('error', 'Usted no posee tarjeta asignada, ingrese una.');
        }
        $cars = Car::where('user_id', $id)->get();
        if ( count($cars) == 0) {
            return redirect('car/create')->with('error', 'Usted no posee un vehiculo asignado.');
        }
        return view('ride.create')->with('cards', $cards)->with('cars', $cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data){
        
        return Validator::make($data, [
            'origin' => 'required|string',
            'destination' => 'required|string',
            'duration' => 'required',
            'amount' => 'required|decimal',
            'remarks' => 'string',
            'departDate' => 'date|required',
            'departHour' => 'required',
        ]);
    }

    public function store(Request $request){
        $account = Account::where('user_id', Auth::user()->id)->first();

        $ride = new Ride;
        $ride->user_id =        Auth::User()->id;
        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        $ride->account_id =     $account->id;
        $ride->card_id =        $request->card;
        $ride->car_id =         $request->car_id;
        $ride->save();
        
        $pilot = Auth::user();
        $car = Car::where('id', $ride->car_id)->first();
        $card = Card::where('id', $ride->card_id)->first();
        $comments = Comment::where('ride_id', $ride->id)->get();
        $solicitudes = PassengerRide::where('ride_id', $ride->id)->where('state', 'pendiente')->where('state', 'aceptado')->get();
        if ($solicitudes->count() == 0) {
            $solicitudes = 'No hay postulaciones';
        }
        if ($comments->count() == 0) {
            $comments = 'Aún no hay comentarios';
        }
        $postulant = collect([]);
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('car', $car)->with('card', $card)->with('ride', $ride)->with('success', 'Viaje publicado!')->with('comments', $comments)->with('postulant', $postulant)->with('pilot', $pilot)->with('solicitudes', $solicitudes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $ride = Ride::find($id);
        $comments = Comment::where('ride_id', $id)->get();
        $car = Car::find($ride->car_id)->first();
        $pilot = User::find($ride->user_id);
        $solicitudes = PassengerRide::where('ride_id', $id)->where('state', 'pendiente')->get();
        if ($solicitudes->count() == 0) {
            $solicitudes = 'No hay postulaciones';
        }
        if ($comments->count() == 0) {
            $comments = 'Aún no hay comentarios';
        }
        $passengerRide = PassengerRide::where('ride_id', $id)->where('user_id', Auth::user()->id)->first();
        $postulant = collect([]);
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('ride', $ride)->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //CONTROLAR QUE NO HAYA COPILOTOS PENDIENTES O ACEPTADOS
        $passengers = PassengerRide::where('ride_id', $id)->where('state', 'aceptado')->where('state', 'pendiente')->get();
        if ($passengers->count() > 0 ){
            return view('ride.show')->with('error', 'Usted poseé usuarios aceptados o pendientes para este viaje');
        }
        $ride = Ride::find($id);
        $cars = Car::where('user_id', Auth::user()->id)->get();
        $cards = Card::where('user_id', Auth::user()->id)->get();
        return view('ride.edit')->with('cars', $cars)->with('cards', $cards)->with('ride', $ride);
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
        //$this->validator($request->all())->validate();

        $ride = Ride::find($id);

        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        //$ride->account_id =     Account::where('user_id', Auth::User()->id);
        $ride->card_id =        $request->card;
        $ride->car_id =        $request->car;
        
        $ride->save();
        
    
        $car = Car::where('id', $ride->car_id)->first();
        $card = Card::where('id', $ride->card_id)->first();
        $pilot = User::find($ride->user_id)->first();
        $solicitudes = PassengerRide::where('ride_id', $id)->where('state', 'pendiente')->get();
        if ($solicitudes->count() == 0) {
            $solicitudes = 'No hay postulaciones';
        }
        $comments = Comment::where('ride_id', $ride->id)->get();
        if ($comments->count() == 0) {
            $comments = 'Aún no hay comentarios';
        }
        $postulant = collect([]);
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('car', $car)->with('card', $card)->with('ride', $ride)->with('success', 'Viaje editado!')->with('comments', $comments)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //SE CONTROLA QUE NO HAYA PASAJEROS ACEPTADOS O PENDIENTES
        //SI HAY, SE LE PREGUNTA SI REALMENTE QUIERE ELIMINAR 
        //ADVIRTIENDO DE LA PENALIZACION
        //SI NO HAY SE LLAMA A DESTROY
        $passengers = PassengerRide::where('ride_id', $id)->where('state', 'aceptado')->where('state', 'pendiente')->get();
        if ($passengers->count() > 0 ){
            return view('ride.show')->with('error', 'Usted poseé usuarios aceptados o pendientes para este viaje. ¿Desea eliminar el viaje de todos modos? (Ustéd será penalizado)');//mandarle un anchor a la pregunta que llame a destroy (en la vista claro)
        }else{
            Ride::destroy($id);
        $rides = Ride::where('user_id', Auth::user()->id)->get();
        //redirecciona a cualquier lugar
        return view('home')->with('rides', $rides)->with('success', 'viaje eliminado');
        }
        
    }

    public function getBy(Request $request){
        $rides = DB::table('rides');

        // Search for a ride based on their destination.
        if ($request->has('destination')) {
            $ride->where('destination', $request->input('destination'));
        }

        // Search for a ride based on their origin.
        if ($request->has('origin')) {
            $ride->where('origin', $request->input('origin'));
        }

        // Search for a ride based on their duration.
        if ($request->has('duration')) {
            $ride->where('duration', $request->input('duration'));
        }

        if ($request->has('departDate')) {
           $ride->where('departDate', $request->input('departDate'));
        }

        // Has an 'departHour' parameter been provided?
        if ($request->has('departHour')) {
            $ride->whereHas('rsvp.departHour', $request->input('departHour'));
        }
      
        if ($request->has('kind')) {
            $ride->whereHas('rides', function ($query) use ($request) {
            $query->where('kind', $request->kind);
            })->get();
        }
        $rides = $rides->get();
        return view('ride.searchResult')->with('rides', $rides);
    }

}
