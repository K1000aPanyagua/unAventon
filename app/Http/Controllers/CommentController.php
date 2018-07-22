<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use Auth;
use App\Ride;
use Illuminate\Support\Facades\Validator;
use App\Car;
use App\PassengerRide;


class CommentController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //EL SHOW DEL VIAJE VA A TENER EL TEXT AREA DE COMENTARIOS
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Almacenamiento
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->ride_id = $request->rideId;
        $comment->user_id = Auth::User()->id;
        $comment->answer = null;

        $comment->save();
        
        //cargo informacion del viaje
        $ride = Ride::find($request->rideId);
        
        //Redireccion
       return redirect()->route('ride.show', [$ride->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //EL CONTROLADOR DE VIAJE SE VA A ENCARGAR DE CARGAR
        //SUS RESPECTIVOS COMENTARIOS
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idComment){
        //LA EDICION DE UN COMENTARIO ES SUPER CHOTA POR QUE NOS VA A
        //REDIRECCIONAR A UN MINIFORM EDIT, Y UNA VEZ HECHO EL UPDATE
        //SE REDIRECCIONA A RIDE SHOW
        $comment = comment::find($id)->first();
        return view('comment.edit')->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_comment){
        $id = Comment::find($id_comment)->first()->ride_id;
        Comment::destroy($id_comment);
        
        //cargo informacion del viaje
        
        $ride = Ride::find($id);
       
        //Redireccion
        return redirect()->route('ride.show', [$ride->id]);
    }

    public function answer(Request $request){
        //Almacenamiento
        $comment = Comment::find($request->commentId)->first();
        $comment->answer = $request->content;
        $comment->save();
        
        //cargo informacion del viaje
        $ride = Ride::find($comment->ride_id);

        //Redireccion
        return redirect()->route('ride.show', [$ride->id]);
    }

}
