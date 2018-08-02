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
use Carbon\Carbon;

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
        $ridesP = Ride::where('user_id', $id)->get();
        $rides = PassengerRide::where('user_id', $id)->get(); /*DE ACA SE SACA EL RIDE ID DE TODOS LOS VIAJES DE LOS QUE SE ES PASAJERO*/
        $ridesC= collect([]);
        $user = User::find($id);
        foreach ($rides as $ride) {
            $ridesC->push(Ride::find($ride->ride_id));
        }
        if ($id != Auth::user()->id) {
            return view('user.showOtherUser', compact('user'))->with('myRides', $ridesP)->with('rides', $ridesC);
        }
        else{
            return view('user.show', compact('user'))->with('myRides', $ridesP)->with('rides', $ridesC);
        }
    }

    public function getCalifications(){
        $asPilot = QualificationPilot::where('pilot_id', (Auth::User()->id))->get();
        $asPassenger = QualificationPassenger::where('passenger_id', (Auth::User()->id))->get();
        dd($asPilot, $asPassenger);
         return view('user.califications')->with('asPilot', $asPilot)->with('asPassenger', $asPassenger);

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
                $ridesP = Ride::where('user_id', $id)->get();
        $rides = PassengerRide::where('user_id', $id)->get(); /*DE ACA SE SACA EL RIDE ID DE TODOS LOS VIAJES DE LOS QUE SE ES PASAJERO*/
        $ridesC= collect([]);
        $user = User::find($id);
        foreach ($rides as $ride) {
            $ridesC->push(Ride::find($ride->ride_id));
        }


        if ($id != Auth::user()->id) {
            return view('/');
        }

        $this->updateValidator($request->all())->validate();

        //Calcula que sea mayor de 18 años
        $fecha = Carbon::parse($request->birthdate);
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;
        $age = Carbon::createFromDate($afecha,$mfecha,$dfecha)->age;
        if($age < 18){
            return redirect()->back()->with('error', 'Lo sentimos... debes tener mas de 18 años.');
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->gender = $request->gender;
        $user->telephone = $request->telephone;
        $user->save();

        //Redireccion
        return view('user.show')->with('user', $user)->with('success', 'Cambios guardados')->with('myRides', $ridesP)->with('rides', $ridesC);
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
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
        if ( $cards->count() == 0) {
            return redirect('card/create')->with('error', 'Usted no posee tarjeta asignada, ingrese una.');
        }
        //valido que haya lugares libres en el vehiculo
        $passengers = PassengerRide::where('ride_id', $idRide)->where('state', 'aceptado')->get();
        if ($passengers->count() == $car->numSeats) {
            return redirect()->back()->with('error', 'No hay lugares deisponibles para este viaje');
        }

        //VALIDACIONES
        $auxRide = PassengerRide::where('user_id', Auth::user()->id)->where('state', 'aceptado')->get();
        if ($auxRide->count() > 0){
            foreach ($auxRide as $currentRide) {
                //valido que el usuario no sea pasajero de un viaje con misma fecha
                $now = Carbon::now();
                if ($currentRide->endDate){
                    /////////////////////DASDASDSNJSDANDANDSNA
                }
                //valido que no adeude pagos
                if ($currentRide->paid == FALSE) {
                    return redirect()->back()->with('error', 'Ustéd adeuda pagos, para abonarlos dirijase a "Mi perfil" y seleccione, en viaje que desea abonar, la opcion: "PAGAR"');

        //VALIDO QUE EL USUARIO NO POSEA ALGÚN VIAJE COMO PILOTO O COPILOTO QUE SE //SUPERPONGA CON EL QUE SE QUIERE POSTULAR 
        $rides = Ride::where('user_id', Auth::user()->id)->where('done', FALSE)->get();
        //
        $ok1 = TRUE;
        $ok2 = TRUE;
        //VERIFICO SI EL VIAJE AL QUE SE QUIERE POSTULAR NO SE SUPERPONE CON OTRO YA //PUBLICADO
        foreach ($rides as $postedRide) {
            if ($ride->departDate->lt($postedRide->departDate)) {
                if ($ride->endDate->lt($postedRide->departDate)) {
                    $ok1 = TRUE;
                }else{
                    $ok1 = FALSE;
                }
            }elseif ($postedRide->endDate->lt($ride->departDate)) {
                $ok1 = TRUE;
            }else{
                $ok1 = FALSE;
            }
        }

        //VERIFICO SI EL VIAJE AL QUE SE QUIERE POSTULAR NO SE SUPERPONE CON UN VIAJE EL CUAL EL USUARIO ES COPILOTO
        $passRides = PassengerRide::where('user_id', Auth::user()->id)->where('state', 'aceptado')->where('paid', NULL)->get();
        $rideAsPass = collect([]);
        if ($passRides->count() > 0){
            foreach ($passRides as $i) {
                $rideAsPass->push(Ride::find($i->ride_id)); 
            }
            foreach ($rideAsPass as $currRide) {
                if ($ride->departDate->lt($currRide->departDate)) {
                    if ($ride->endDate->lt($currRide->departDate)) {
                        $ok2 = TRUE;
                    }else{
                        $ok2 = FALSE;
                    }
                }elseif ($currRide->endDate->lt($ride->departDate)) {
                    $ok2 = TRUE;
                }else{
                    $ok2 = FALSE;
                }
            }
        }
        if ($ok1 == FALSE or $ok2 == FALSE) {
            return redirect()->back()->with('error', 'Ustéd poseé uno o más viajes que se superponen con el que desea postularse en este momento');
        }
        //VALIDO QUE NO SE ADEUDE PAGOS COMO PILOTO O COPILOTO
        $auxRide = Ride::where('user_id', Auth::user()->id)->where('paid', FALSE)->where('done', TRUE)->get();
        $ridesPassenger = PassengerRide::where('user_id', Auth::user()->id)->where('paid', FALSE)->get();
        //adeuda como piloto?
        if ($auxRide->count() > 0) {
           return redirect()->back()->with('error', 'Ustéd adeuda pagos, para abonarlos dirijase a "Mi perfil" y seleccione, en viaje que desea abonar, la opcion: "PAGAR"');//!!!!!!!!!!!!!!!!!!!!!!!!!arrglar redirect
        }
        //adeuda como pasajero?
        if ($ridesPassenger->count() > 0) {
            return redirect()->back()->with('error', 'Ustéd adeuda pagos, para abonarlos dirijase a "Mi perfil" y seleccione, en viaje que desea abonar, la opcion: "PAGAR"');//!!!!!!!!!!!!!!!!!!!!!!!!!arrglar redirect
        }
        //valido que no adeude calificaciones
        $qualificationsAsPassenger = QualificationPassenger::where('pilot_id', Auth::user()->id)->where('done', FALSE)->get();
        if ($qualificationsAsPassenger->count() > 0) {
            return redirect()->back()->with('error', 'Ustéd adeuda calificaciones');
        }
        $qualificationsAsPilot = QualificationPilot::where('passenger_id', Auth::user()->id)->where('done', FALSE)->get();
        if ($qualificationsAsPilot->count() > 0) {
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
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('ride', $ride)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant)->with('disponible', $disponible);
    }   
}}
}

    public function cancelSolicitude($idRide){
        $solicitude = PassengerRide::where('user_id', Auth::user()->id)->where('ride_id', $idRide)->first();
        if ($solicitude->state == 'aceptado') {
            //SI FUÉ ACEPTADO PENALIZO 
            $user = User::find(Auth::user()->id);
            $user->reputation = $user->reputation - 1;
            $user->save();
            
            PassengerRide::destroy($solicitude->id);

        }else{
            PassengerRide::destroy($solicitude->id);
        }
        
        $solicitudes = null;
        $ride = Ride::where('id', $idRide)->first();
        $comments = Comment::where('ride_id', $idRide)->get();
        $car = Car::where('id', $ride->car_id)->first();
        $pilot = User::find($ride->user_id)->first();
        $solicitudes = PassengerRide::where('ride_id', $idRide)->where('state', 'pendiente')->get();
        $postulant = null;
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
        
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('solicitudes', $solicitudes)->with('ride', $ride)->with('pilot', $pilot)->with('postulant', $postulant)->with('disponible', $disponible);
    }

    public function acceptSolicitude($idRide, $idPostulant){
        $ride = Ride::where('id', $idRide)->first();
        //
        $ok = TRUE;
        //NO ES POSIBLE QUE EL POSTULANTE POSEA VIAJES COMO PILOTO QUE SE SUPERPONGAN
        //YA QUE UN USUARIO NO PUEDE POSTULARSE A UN VIAJE QUE SE SUPERPONE
        
        //VERIFICO SI EL POSTULANTE HA SIDO ACEPTADO EN OTRO VIAJE QUE SE SUPERPONE
        $passRides = PassengerRide::where('user_id', $idPostulant)->where('state', 'aceptado')->where('paid', NULL)->get();
        $rideAsPass = collect([]);
        if ($passRides->count() > 0){
            foreach ($passRides as $i) {
                $rideAsPass->push(Ride::find($i->ride_id)); 
            }
            foreach ($rideAsPass as $currRide) {
                if ($ride->departDate->lt($currRide->departDate)) {
                    if ($ride->endDate->lt($currRide->departDate)) {
                        $ok = TRUE;
                    }else{
                        $ok = FALSE;
                    }
                }elseif ($currRide->endDate->lt($ride->departDate)) {
                    $ok = TRUE;
                }else{
                    $ok = FALSE;
                }
            }
        }
        if ($ok == FALSE) {
            $erase = PassengerRide::where('ride_id', $idRide)->where('user_id', $idPostulant)->first();
            $erase->delete();
            return redirect()->back()->with('error', 'Esta solicitud ya no es válida');
        }
        //
        $aux = PassengerRide::where('ride_id', $idRide)->where('user_id', $idPostulant)->first();
        $aux->state = 'aceptado';
        $aux->save();

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
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
        if ($aux->count() == $car->numSeats) {
            return redirect()->back()->with('error', 'No hay lugares disponibles para este viaje');
        }
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('solicitudes', $solicitudes)->with('ride', $ride)->with('passengers', $passengers)->with('pilot', $pilot)->with('postulant', $postulant)->with('disponible', $disponible);
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
        $disponible= ($car->numSeats) - (PassengerRide::where('ride_id', $ride->id)->where('state', 'aceptado')->get()->count());
        if ($solicitudes != 'No hay postulaciones'){
            foreach ($solicitudes as $solicitude) {
                $postulant->push(User::find($solicitude->user_id));
            }
        }
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('solicitudes', $solicitudes)->with('ride', $ride)->with('passengers', $passengers)->with('pilot', $pilot)->with('postulant', $postulant)->with('disponible', $disponible);
    }

    public function deletePassenger(Request $Request, $idRide, $idPassenger){
        //PENALIZO AL USUARIO
        $user = User::find(Auth::user()->id);
        $user->reputation = $user->reputation - 1;
        $user->save();
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

        $passenger = User::find($passenger_id);

        if ($qualification->value = 'positivo') {
            $passenger->reputation = $passenger->reputation + 1;
        }elseif ($qualification->value = 'negativo') {
            $passenger->reputation = $passenger->reputation - 1;
        }
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

        $pilot = User::find($pilot_id);

        if ($qualification->value = 'positivo') {
            $pilot->reputation = $pilot->reputation + 1;
        }elseif ($qualification->value = 'negativo') {
            $pilot->reputation = $pilot->reputation - 1;
        }

        return redirect()->back();
    }

    public function payRide($ride_id){
        $ride = Ride::find($ride_id);
        $cards=Card::where('user_id', Auth::user()->id)->get();
        return view('user.payRide')->with('ride', $ride)->with('cards', $cards);
    }

    public function pay(Request $request, $ride_id){
        $ride=Ride::find($ride_id);
        $num=rand(5, 20);
        if (($num % 2) == 0){
            if ($ride->user_id == Auth::user()->id){
                $ride->paid = TRUE;
                $ride->save();

                return redirect()->back()->with('success', 'Pago exitoso!');
            }else{
                $passengerRide = PassengerRide::where('ride_id', $ride->id)->where('user_id', Auth::user()->id)->first();
                $passengerRide->paid = TRUE;
                $passengerRide->save();
                return redirect()->back()->with('success', 'Pago exitoso!'); 
            }

        }
        else{

            return redirect()->back()->with('error', 'Ha ocurrido un problema, el pago ha fallado...');
        }
    }

}

