<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\User;
use App\PassengerRide;
use App\QualificationPassenger;
use App\QualificationPilot;
use App\Comment;
use App\Car;
use App\Ride;
use App\Card;

class UserController extends Controller{
  
    /*public function __construct()
    {
        $this->middleware('guest');
    }
    */
    public function index() 
    {
        //
    }

   
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        $user = User::find($id);
        if ($id != Auth::user()->id) {
            return view('user.showOtherUser', compact('user'));
        }
        else{
            return view('user.show', compact('user'));
        }
    }


    public function editPassword(){
        
        return view('user.passForm');
    }
    
    public function edit($id){
        //Carga vista de editar perfil

        $user=User::find($id);
        return view('user.edit')->with('user', $user);
    }

    protected function validator(array $data){
        
        return Validator::make($data, [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users',
        ]);
    }


    protected function updateValidator(array $data){
        
        return Validator::make($data, [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
        ]);
    }


    protected function passValidator(array $data){
        return  Validator::make($data, [
            'nuevaContraseña' => 'string|required|min:6'
            ]);
    }


    public function update(Request $request, $id){
        if ($id != Auth::user()->id) {
            return view('/');
        }

        $this->updateValidator($request->all())->validate();
        $user = User::find($id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->gender = $request->gender;
        $user->telephone = $request->telephone;
        $user->save();

        //Redireccion
        return view('user.show')->with('user', $user)->with('success', 'Cambios guardados');
    }

    public function destroy($id){   
        if ($id != Auth::user()->id) {
            return view('/');
        }
        User::destroy($id);
        return redirect('/')->with('success', 'Usuario eliminado');
    }

    public function updatePassword(Request $request){
        $this->passValidator($request->all())->validate();
        $passw = $request->input('pass');
        
        if (\Hash::check($passw, Auth::user()->pass)){
            Auth::user()->pass = bcrypt($request->input('nuevaContraseña'));
            Auth::user()->save();
        return redirect('/editPass')->with('user', Auth::user()->email)->with('success', 'Cambios guardados');
        }
        else{
            return redirect('/editPass')->with('user', Auth::user()->email)->with('error', 'Contraseña actual incorrecta');
        }
    }

    public function postulate(Request $request, $idRide){
        //UN USUARIO QUE NO POSEA TARJETA NO PODRÁ POSTULARSE
        //TAMPOCO PODRÁ POSTULARSE SI HA SIDO ACEPTADO EN UN VIAJE
        //QUE SE SUPERPONGA 
        //UN USUARIO CON UN PAGO ADEUDADO NO PODRÁ POSTULARSE
        //UN USUARIO UNA CALIFICACIÓN PENDIENTE NO PODRÁ POSTULARSE
        if (!Auth::check()) {
            return redirect('/register')->with('error','Registrate para postularte a un viaje!');
        }

        //cargo datos del viaje
        $ride = Ride::where('id', $idRide)->first();
        $comments = Comment::where('ride_id', $idRide)->get();
        $car = Car::where('id', $ride->car_id)->first();
        $solicitudes = null;
        $pilot = User::find($ride->user_id)->first();
        //valido que el usuario tenga tarjeta
        $cards = Card::where('user_id', Auth::user()->id)->get();
        if ( $cards->count() == 0) {
            return redirect('card/create')->with('error', 'Usted no posee tarjeta asignada, ingrese una.');
        }
        //valido que haya lugares libres en el vehiculo
        $passengers = PassengerRide::where('ride_id', $idRide)->where('state', 'aceptado')->get();
        if ($passengers->count() == $car->numSeats) {
            return redirect()->back()->with('error', 'No hay lugares deisponibles para este viaje');
        }

        //valido que el usuario no sea pasajero de un viaje con misma fecha
        $auxRide = PassengerRide::where('user_id', Auth::user()->id)->where('state', 'aceptado')->get();
        $endDate = date('m-d-Y H:i:s',strtotime($ride->duration, strtotime($ride->departTime)));
        if ($auxRide->count() > 0){
            foreach ($auxRide as $currentRide) {
                $endDateVal = date('m-d-Y H:i:s',strtotime($auxRide->duration, strtotime($auxRide->departTime)));
                if (!($ride->departTime > $auxRide->departTime && !($ride->departTime > $endDateVal))) {
                    return redirect()->back()->with('error', 'Usted poseé un viaje como pasajero el cual se superpone con el viaje al que usted desea postularse');
                }elseif (!($endDate < $auxRide->departTime && !($endDate < $endDateVal))) {
                    return redirect()->back()->with('error', 'Usted poseé un viaje como pasajero el cual se superpone con el viaje al que usted desea postularse');
                }
                //valido que no adeude pagos
                if ($currentRide->paid == FALSE) {
                    return redirect()->back()->with('error', 'Ustéd adeuda pagos');
                }

            }
        }
        //valido que no adeude calificaciones
        $qualificationsAsPassenger = QualificationPassenger::where('done', FALSE)->first();
        if ($qualificationsAsPassenger != null) {
            return redirect()->back()->with('error', 'Ustéd adeuda calificaciones');
        }
        $qualificationsAsPilot = QualificationPilot::where('done', FALSE)->first();
        if ($qualificationsAsPilot != null) {
            return redirect()->back()->with('error', 'Ustéd adeuda calificaciones');
        }

        $passengerRide = new PassengerRide;
        $passengerRide->user_id = Auth::user()->id;
        $passengerRide->ride_id = $idRide;
        $passengerRide->state = "pendiente";
        $passengerRide->save();
        
        $postulant = null;
        if ($solicitudes != null){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('ride', $ride)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant);
    }   

    public function cancelSolicitude($idRide){
        $solicitude = PassengerRide::where('user_id', Auth::user()->id)->where('ride_id', $idRide)->first();
        if ($solicitude->state == 'aceptado') {
            //!!!!!!!!!!!!!!!!!!!!!!FALTA PENALIZAR AL USUARIO!!!!!!!!!!!!!!!!!
            PassengerRide::destroy($solicitude->id);
        }
        PassengerRide::destroy($solicitude->id);
        
        $solicitudes = null;
        $ride = Ride::where('id', $idRide)->first();
        $comments = Comment::where('ride_id', $idRide)->get();
        $car = Car::where('id', $ride->car_id)->first();
        $pilot = User::find($ride->user_id)->first();
        $solicitudes = PassengerRide::where('ride_id', $idRide)->where('state', 'pendiente')->get();
        $postulant = null;
        
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('solicitudes', $solicitudes)->with('ride', $ride)->with('pilot', $pilot)->with('postulant', $postulant);
    }

    public function acceptSolicitude($idRide, $idPostulant){
        $aux = PassengerRide::where('ride_id', $idRide)->where('user_id', $idPostulant)->first();
        $aux->state = 'aceptado';
        $aux->save();

        //CREO LAS TABLAS DE CALIFICACION PENDIENTE
        $qualificationPilot = new QualificationPilot;
        $qualificationPilot->value = null;
        $qualificationPilot->pilot_id = Auth::user()->id;
        $qualificationPilot->passenger_id = $idPostulant;
        $qualificationPilot->review = null;
        $qualificationPilot->ride_id = $idRide;
        $qualificationPilot->done = FALSE;

        $qualificationPilot->save();
        //
        $qualificationPassenger = new QualificationPassenger;
        $qualificationPassenger->value = null;
        $qualificationPassenger->pilot_id = Auth::user()->id;
        $qualificationPassenger->passenger_id = $idPostulant;
        $qualificationPassenger->review = null;
        $qualificationPassenger->ride_id = $idRide;
        $qualificationPassenger->done = FALSE;

        $qualificationPassenger->save();

        //CARGO LAS SOLICITUDES Y TODOS LOS DATOS NECESARIOS PARA LA VISTA DEL VIAJE
        $solicitudes = PassengerRide::where('ride_id', $idRide)->where('state', 'pendiente')->get();
        $postulant = collect([]);
        //CARGO LOS POSTULANTES PARA MOSTRARLOS EN LA VISTA
        foreach ($solicitudes as $i) {    
            $postulant->push(User::find($i->user_id)->first());
        }
        if ($solicitudes->count() == 0) {
            $solicitudes = 'No hay postulaciones';
        }
        $ride = Ride::where('id', $idRide)->first();
        $comments = Comment::where('ride_id', $idRide)->get();
        $car = Car::where('id', $ride->car_id)->first();
        $pilot = User::find($ride->user_id)->first();
        $passengers = PassengerRide::where('ride_id', $idRide)->where('state', 'aceptado')->get();
        if ($aux->count() == $car->numSeats) {
            return redirect()->back()->with('error', 'No hay lugares disponibles para este viaje');
        }
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('solicitudes', $solicitudes)->with('ride', $ride)->with('passengers', $passengers)->with('pilot', $pilot)->with('postulant', $postulant);
    }

    public function declineSolicitude(Request $request, $idRide, $idPostulant){
        $aux = PassengerRide::where('ride_id', $idRide)->where('user_id', $idPostulant)->first();
        $aux->state = 'rechazado';
        $aux->save();

        $passengers = null;
        $solicitudes = PassengerRide::where('ride_id', $idRide)->where('state', 'pendiente')->get();
        if ($solicitudes->count() == 0) {
            $solicitudes = 'No hay postulaciones';
        }
        $ride = Ride::where('id', $idRide)->first();
        $comments = Comment::where('ride_id', $idRide)->get();
        $car = Car::where('id', $ride->car_id)->first();
        $pilot = User::find($ride->user_id)->first();
        $postulant = collect([]);
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('solicitudes', $solicitudes)->with('ride', $ride)->with('passengers', $passengers)->with('pilot', $pilot)->with('postulant', $postulant);
    }

    public function deletePassenger(Request $Request, $idRide, $idPassenger){
        //!!!!!!!!!!!!!!FALTA PENALIZAR AL USUARIO!!!!!!!!!!!!!!!!!!!!
        
        //ELIMINO LAS TABLAS DE CALIFICACIONES
        $qualificationPassenger = QualificationPassenger::where('ride_id', $idRide)->where('passenger_id', $idPassenger)->first();
        $qualificationPassenger->delete();
        //
        $qualificationPilot = QualificationPilot::where('ride_id', $idRide)->where('passenger_id', $idPassenger)->first();
        $qualificationPilot->delete();
        //
        $passenger = PassengerRide::where('ride_id', $idRide)->where('user_id', $idPassenger)->first();
        $passenger->state = 'eliminado';
        $passenger->save();
        
        $passengers = PassengerRide::where('ride_id', $idRide)->where('state', 'aceptado');
        return view('ride.showPassengers')->with('passengers', $passengers);
    }

    public function qualificatePassenger(Request $request, $ride_id, $passenger_id){
        $qualification = QualificationPassenger::where('ride_id', $ride_id)->where('passenger_id', $passenger_id)->first();
        $qualification->value = $request->value;
        $qualification->pilot_id = Auth::user()->id;
        $qualification->passenger_id = $passenger_id;
        $qualification->review = $request->review;
        $qualification->ride_id = $ride_id;
        $qualification->done = TRUE;

        $qualification->save();

        return redirect()->back();
    }

    public function qualificatePilot(Request $request, $ride_id, $pilot_id){
        $qualification = QualificationPilot::where('ride_id', $ride_id)->where('pilot_id', $pilot_id)->where('passenger_id', Auth::user()->id)->first();
        $qualification->value = $request->value;
        $qualification->pilot_id = $pilot_id;
        $qualification->passenger_id = Auth::user()->id;
        $qualification->review = $request->review;
        $qualification->ride_id = $ride_id;
        $qualification->done = TRUE;

        $qualification->save();

        return redirect()->back();
    }

}

