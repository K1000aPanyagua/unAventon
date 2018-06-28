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
        if ($id != Auth::user()->id) {
            return view('user.showOtherUser');
        }

        $user = User::find($id);
        return view('user.show', compact('user'));
    }


    public function editPassword(){
        if ($id != Auth::user()->id) {
            return redirect('/');

        }
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

    public function postulate(Request $request, $idViaje){
        //UN USUARIO QUE NO POSEA TARJETA NO PODRÁ POSTULARSE
        //TAMPOCO PODRÁ POSTULARSE SI HA SIDO ACEPTADO EN UN VIAJE
        //QUE SE SUPERPONGA 
        //UN USUARIO CON UN PAGO ADEUDADO NO PODRÁ POSTULARSE
        //UN USUARIO UNA CALIFICACIÓN PENDIENTE NO PODRÁ POSTULARSE
        if (!Auth::check()) {
            return redirect('/register')->with('error','Registrate para postularte a un viaje!');
        }

        //cargo datos del viaje
        $ride = Ride::where('id', $idViaje)->first();
        $comments = Comment::where('ride_id', $idViaje)->get();
        $car = Car::where('id', $ride->car_id)->first();

        //valido que el usuario tenga tarjeta
        $cards = Card::where('user_id', Auth::user()->id)->get();
        if ( count($cards) == 0) {
            return redirect('card/create')->with('error', 'Usted no posee tarjeta asignada, ingrese una.');
        }

        //valido que el usuario no sea pasajero de un viaje con misma fecha
        $auxRide = PassengerRide::where('user_id', Auth::user()->id)->where('state', 'aceptado')->get();
        $endDate = date('m-d-Y H:i:s',strtotime($ride->duration, strtotime($ride->departTime)));
        if (count($auxRide) > 0){
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
        $passengerRide->ride_id = $idViaje;
        $passengerRide->state = "pendiente";
        $passengerRide->save();
        
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('ride', $ride);
    }   

    public function cancelSolicitude(Request $request ,$idViaje){
        $solicitude = PassengerRide::where('user_id', Auth::user()->id)->where('ride_id', $idViaje)->first();
        if ($solicitude->state == 'aceptado') {
            //SE PENALIZA AL USUARIO
        }
        PassengerRide::destroy($solicitude->id);
        $passengerRide = null;
        $ride = Ride::where('id', $idViaje)->first();
        $comments = Comment::where('ride_id', $idViaje)->get();
        $car = Car::where('id', $ride->car_id)->first();
        return view('ride.show')->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('ride', $ride);
    }
}


   /*  if ($id != Auth::user()->id) {
            return view('/');
        }

        $passw = $request->input('pass');
        $nuevaContraseña = $request->input('nuevaContraseña');
        return  Validator::make($request, ['pass' => 'string|required|min:6']);