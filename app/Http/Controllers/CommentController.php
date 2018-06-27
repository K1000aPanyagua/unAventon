<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use Auth;
use App\Ride;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ride_id){
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
    public function store(Request $request, $ride_id)
    {   
        //Validacion
        $this->validator($request->all())->validate();
        //Almacenamiento
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->ride_id = $ride_id;
        $comment->user_id = Auth::User()->id;

        $comment->save();
        $ride = Ride::find($ride_id);
        
        //Redireccion
        return view('ride.show')->with('ride', $ride);
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
    public function edit($id_comment){
        //LA EDICION DE UN COMENTARIO ES SUPER CHOTA POR QUE NOS VA A
        //REDIRECCIONAR A UN MINIFORM EDIT, Y UNA VEZ HECHO EL UPDATE
        //SE REDIRECCIONA A RIDE SHOW
        $comment = comment::find($id);
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
        //Validacion
        $this->validator($request->all())->validate();
        //Almacenamiento
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();

        $ride = Ride::find($ride_id);
        //Redireccion
        return view('ride.show')->with('success', 'Cambios guardados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_comment){
        Comment::destroy($id_comment);
        return view('ride.show');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'content' => 'required',
        ]);
    }

}
