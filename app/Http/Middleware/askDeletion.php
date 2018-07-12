<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Car;
use App\Ride;
use App\Comment;
use App\User;
use App\PassengerRide;

class askDeletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next){
        //SE CONTROLA QUE NO HAYA PASAJEROS ACEPTADOS O PENDIENTES
        //SI HAY, SE LE PREGUNTA SI REALMENTE QUIERE ELIMINAR 
        //ADVIRTIENDO DE LA PENALIZACION
        //SI NO HAY SE LLAMA A DESTROY
        $id = $request->route('id');
        $ride = Ride::find($id)->first();
        $comments = Comment::where('ride_id', $id)->get();
        $car = Car::find($ride->car_id)->first();
        $pilot = User::find($ride->user_id)->first();
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
        $passengers = PassengerRide::where('ride_id', $id)->where('state', 'aceptado')->get();

        if ($passengers->count() > 0 ){

            return redirect()->back()->with('ride', $ride)->with('comments', $comments)->with('car', $car)->with('passengerRide', $passengerRide)->with('pilot', $pilot)->with('solicitudes', $solicitudes)->with('postulant', $postulant)->with('rideConfirmationDelete', 'Usted poseé usuarios aceptados o pendientes para este viaje. ¿Desea eliminar el viaje de todos modos? (Ustéd será penalizado)');//mandarle un anchor a la pregunta que llame a destroy (en la vista claro);
        }
    
        return $next($request);
    }
}
