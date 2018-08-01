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
use Carbon\Carbon;
use App\QualificationPilot;
use App\QualificationPassenger;


class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index(){
        //
    }

    public function myRides($user_id){
        //RETORNA VISTA CON VIAJES A LOS QUE ESTA ASOCIADO UN USUARIO, TANTO COMO PILOTO COMO COPILOTO.
        $myRides= Ride::where('user_id', $user_id)->get();
        $rides= PassengerRide::where('user_id', $user_id)->get();
        return view('user.myRides')->with('myRides', $myRides)->with('rides', $rides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //VERIFICAR QUE USUARIO TENGA TARJETA, VEHICULO NO ADEUDE PAGOS NI CALIFICACIONES
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
        $rides = Ride::where('paid', FALSE)->where('done', TRUE)->where('user_id', $id)->get();
        $ridesPassenger = PassengerRide::where('user_id', $id)->where('paid', FALSE)->get();
        //adeuda como piloto?
        if ($rides->count() > 0) {
           return redirect()->back()->with('error', 'Ustéd adeuda pagos');//!!!!!!!!!!!!!!!!!!!!!!!!!arrglar redirect
        }
        //adeuda como pasajero?
        if ($ridesPassenger->count() > 0) {
            return redirect()->back()->with('error', 'Ustéd adeuda pagos');//!!!!!!!!!!!!!!!!!!!!!!!!!arrglar redirect
        }
        $qualifications1 = QualificationPilot::where('passenger_id', $id)->where('done', FALSE)->get();
        $qualifications2 = QualificationPassenger::where('pilot_id', $id)->where('done', FALSE)->get();
        if ($qualifications1->count() > 0 || $qualifications2->count() > 0){
           return redirect()->back()->with('error', 'Ustéd adeuda calificaciones');//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!arreglar redirect
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

        $today=Carbon::now();
        return Validator::make($data, [
            'origin' => 'required|string',
            'destination' => 'required|string',
            'duration' => 'required',
            'amount' => 'required|decimal',
            'remarks' => 'string',
            'departHour' => 'required',
            'departDate' => 'required|after:'.$today,
        ]);
    }

    public function store(Request $request){
        //$this->validator($request->all())->validate();
        $rides = Ride::where('user_id', Auth::user()->id)->where('done', FALSE)->get();
        //CALCULO endDate DEL NUEVO VIAJE
        $duration = Carbon::parse($request->duration);
        $departHour = Carbon::parse($request->departHour);
        $aux = Carbon::parse($request->departDate);
        $endDate = $aux;
        $endDate->addMinutes($duration->minute);
        $endDate->addHours($duration->hour);
        $endDate->addMinutes($departHour->minute);
        $endDate->addHours($departHour->hour);
        //
        $aux = Carbon::parse($request->departDate);
        $departDate = $aux;
        $departDate->addMinutes($departHour->minute);
        $departDate->addHours($departHour->hour);
        //
        $ok1 = TRUE;
        $ok2 = TRUE;
        //VERIFICO SI EL VIAJE QUE SE QUIERE PUBLICAR NO SE SUPERPONE CON OTRO YA PUBLICADO
        foreach ($rides as $postedRide) {
            if ($departDate->lt($postedRide->departDate)) {
                if ($endDate->lt($postedRide->departDate)) {
                    $ok1 = TRUE;
                }else{
                    $ok1 = FALSE;
                }
            }elseif ($postedRide->endDate->lt($departDate)) {
                $ok1 = TRUE;
            }else{
                $ok1 = FALSE;
            }
        }

        //VERIFICO SI EL VIAJE QUE SE QUIERE PUBLICAR NO SE SUPERPONE CON UN VIAJE EL CUAL EL PILOTO ES COPILOTO
        $passRides = PassengerRide::where('user_id', Auth::user()->id)->where('state', 'aceptado')->where('paid', NULL)->get();
        $rideAsPass = collect([]);
        if ($passRides->count() > 0){
            foreach ($passRides as $i) {
                $rideAsPass->push(Ride::find($i->ride_id)); 
            }
            foreach ($rideAsPass as $currRide) {
                if ($departDate->lt($currRide->departDate)) {
                    if ($endDate->lt($currRide->departDate)) {
                        $ok2 = TRUE;
                    }else{
                        $ok2 = FALSE;
                    }
                }elseif ($currRide->endDate->lt($departDate)) {
                    $ok2 = TRUE;
                }else{
                    $ok2 = FALSE;
                }
            }
        }
        if ($ok1 == FALSE or $ok2 == FALSE) {
            return redirect()->back()->with('error', 'Ustéd poseé uno o más viajes que se superponen con el que desea publicar en este momento');
        }
        //

        $ride = new Ride;
        $ride->user_id =        Auth::User()->id;
        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        $ride->car_id =         $request->car_id;
        $ride->card_id =        $request->card;
        $ride->done =           FALSE;
        $ride->paid =           FALSE; 
        $ride->endDate =        $endDate;
        
        $ride->save();
        
        //
        $pilot = Auth::user();
        $car = Car::where('id', $ride->car_id)->first();
        $card = Card::where('id', $ride->card_id)->first();
        $comments = Comment::where('ride_id', $ride->id)->get();
        $solicitudes = PassengerRide::where('ride_id', $ride->id)->where('state', 'pendiente')->where('state', 'aceptado')->get();
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
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
        return view('ride.show')->with('car', $car)->with('card', $card)->with('ride', $ride)->with('success', 'Viaje publicado!')->with('comments', $comments)->with('postulant', $postulant)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('disponible', $disponible);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $this->checkRide($id);
        $ride = Ride::find($id);
        $comments = Comment::where('ride_id', $id)->get();
        $car = Car::find($ride->car_id)->first();
        $pilot = User::find($ride->user_id);
        $solicitudes = PassengerRide::where('ride_id', $id)->where('state', 'pendiente')->get();
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
        
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
        if (Auth::check()) {
          $passengerRide = PassengerRide::where('ride_id', $id)->where('user_id', Auth::user()->id)->first();
          return view('ride.show')->with('ride', $ride)->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant)->with('disponible', $disponible);
        }
        else {
          return view('ride.show')->with('ride', $ride)->with('comments', $comments)->with('car', $car)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant)->with('disponible', $disponible);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $ride = Ride::find($id);
        //CONTROLAR QUE NO HAYA COPILOTOS PENDIENTES O ACEPTADOS
        $passengers = PassengerRide::where('ride_id', $id)->where('state', 'aceptado')->orwhere('state', 'pendiente')->get();
        if ($passengers->count() > 0 ){
            return redirect()->route('ride.show', [$ride->id])->with('error', 'Usted no puede editar este viaje ya que poseé usuarios aceptados o pendientes.');
        }
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
        //$this->Validator($request->all())->validate();

        $ride = Ride::find($id);

        $ride->origin =         $request->origin;
        $ride->destination =    $request->destination;
        $ride->duration =       $request->duration;
        $ride->amount =         $request->amount;
        $ride->remarks =        $request->remarks;
        $ride->departDate =     $request->departDate;
        $ride->departHour =     $request->departHour;
        $ride->card_id =        $request->card;
        $ride->car_id =        $request->car;
        
        //CALCULO endDate 
        $duration = Carbon::parse($request->duration);
        $departHour = Carbon::parse($request->departHour);
        $aux = Carbon::parse($request->departDate);
        $endDate = $aux;
        $endDate->addMinutes($duration->minute);
        $endDate->addHours($duration->hour);
        $endDate->addMinutes($departHour->minute);
        $endDate->addHours($departHour->hour);
        $ride->endDate = $endDate;
        //

        $ride->save();
        
        //
        $car = Car::where('id', $ride->car_id)->first();
        $card = Card::where('id', $ride->card_id)->first();
        $pilot = User::find($ride->user_id)->first();
        $solicitudes = PassengerRide::where('ride_id', $id)->where('state', 'pendiente')->get();
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
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
        return view('ride.show')->with('car', $car)->with('card', $card)->with('ride', $ride)->with('success', 'Viaje editado!')->with('comments', $comments)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant)->with('disponible', $disponible);
        
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
        $passengers = PassengerRide::where('ride_id', $id)->where('state', 'aceptado')->get();
        if ($passengers->count() > 0 ){
            return redirect()->back()->with('rideConfirmationDelete', 'Usted poseé usuarios aceptados o pendientes para este viaje. ¿Desea eliminar el viaje de todos modos? (Ustéd será penalizado por cada pasajero aceptado)');//mandarle un anchor a la pregunta que llame a destroy (en la vista claro)
        }else{
            $qualiPilot = QualificationPilot::where('ride_id', $id)->get();
            if ($qualiPilot != null) {
                foreach ($qualiPilot as $singleQuali) {
                     QualificationPilot::destroy($singleQuali->id);
                }
            }
            $qualiPassenger = QualificationPassenger::where('ride_id', $id)->get();
            if ($qualiPassenger != null) {
                foreach ($qualiPassenger as $singleQuali) {
                     QualificationPassenger::destroy($singleQuali->id);
                }
            }
            $comments = Comment::where('ride_id', $id)->get();
            if ($comments != null) {
                foreach ($comments as $comment) {
                     Comment::destroy($comment->id);
                }
            }
            $passengerRide = PassengerRide::where('ride_id', $id)->get();
            if ($passengerRide != null) {
                foreach ($passengerRide as $i) {
                     PassengerRide::destroy($i->id);
                }
            }
            Ride::destroy($id);
        $rides = Ride::all();
        //redirecciona a cualquier lugar
        return redirect('/')->with('rides', $rides)->with('success', 'viaje eliminado');
        }
    }
    
    public function delete($id){
        //SI LLEGO ACA ES  POR QUE HAY COPILOTOS ACEPTADOS
        $passengers = PassengerRide::where('ride_id', $id)->get();
        $user = User::find(Auth::user()->id);
        foreach ($passengers as $passenger) {
            $user->reputation = $user->reputation - 1;
            $user->save();
            $passenger->delete();
        }
        $comments = Comment::where('ride_id', $id)->get();
        if ($comments != null) {
            foreach ($comments as $comment) {
                Comment::destroy($comment->id);
            }
        }

        Ride::destroy($id);
        $rides = Ride::all();
        return view('home')->with('rides', $rides)->with('success', 'viaje eliminado');
    }

    public function getBy(Request $request){
        $rides = DB::table('rides');

        // Search for a ride based on their destination.
        if ($request->has('destination')) {
            $rides->where('destination', $request->input('destination'));
        }

        // Search for a ride based on their origin.
        if ($request->has('origin')) {
            $rides->where('origin', $request->input('origin'));
        }

        // Search for a ride based on their duration.
        if ($request->has('duration')) {
            $rides->where('duration', $request->input('duration'));
        }

        if ($request->has('departDate')) {
           $rides->where('departDate', $request->input('departDate'));
        }

        // Has an 'departHour' parameter been provided?
        if ($request->has('departHour')) {
            $rides->where('departHour', $request->input('departHour'));
        }

        if ($request->has('endDate')) {
           $rides->where('endDate', $request->input('endDate'));
        }
            //NO SE COMO TRAERME LA CANTIDAD DE ASIENTOS O EL TIPO DE AUTO
            //ESTAS QUIERYS INVOLUCRAN ACCEDER A LA TABLA DEL CAMPO FORÁNEO
            //DE CARS
        
        if ($request->has('amount')) {
           $rides->where('amount', $request->input('amount'));
        }
      
        #if ($request->has('kind')) {
           # $rides->whereHas('rides', function ($query) use ($request) {
          #      $query->where('kind', $request->input('kind'))->get();
         #   });
        #}
        
        $rides = $rides->get();
        if ($rides->count() < 1){
            $rides = 'No hay resultados.';
            return view('ride.searchResult')->with('rides', $rides);
        }
        return view('ride.searchResult')->with('rides', $rides);
    }

    public function checkRide($id){
        $ride = Ride::find($id);
        $now = Carbon::now();
        if ($now->gt($ride->endDate)) {
            $ride->done = TRUE;
            $ride->save();

            $passengers = PassengerRide::where('ride_id', $id)->where('state', 'aceptado')->get();
            //CREO LAS TABLAS DE CALIFICACION PENDIENTE
            if ($passengers->count() > 0 ){
                foreach ($passengers as $passenger) {
                    $qualificationPilot = new QualificationPilot;
                    $qualificationPilot->value = null;
                    $qualificationPilot->pilot_id = $ride->user_id;
                    $qualificationPilot->passenger_id = $passenger->id;
                    $qualificationPilot->review = null;
                    $qualificationPilot->ride_id = $id;
                    $qualificationPilot->done = FALSE;

                    $qualificationPilot->save();
            //
                    $qualificationPassenger = new QualificationPassenger;
                    $qualificationPassenger->value = null;
                    $qualificationPassenger->pilot_id = $ride->user_id;
                    $qualificationPassenger->passenger_id = $passenger->id;
                    $qualificationPassenger->review = null;
                    $qualificationPassenger->ride_id = $id;
                    $qualificationPassenger->done = FALSE;

                    $qualificationPassenger->save();      
                    //SETEO EN FALSE EL PAID PARA EL PASSENGER
                    $passenger->paid = FALSE;
                    $passenger->save();     
                }
            }
        }
    }
}

