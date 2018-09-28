    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Ride;

class AnswerController extends Controller
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
        //EL SHOW DEL VIAJE VA A TENER LA OPCIÓN DE RESPONDER
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ride_id, $comment_id)
    {   
        //Validacion
        $this->validator($request->all())->validate()
        //Almacenamiento
        $answer = new Answer;
        $answer->content = $request->content;
        $answer->ride_id = $ride_id;
        $answer->comment_id = $comment_id;

        $answer->save();
        $ride = Ride::find($ride_id);
        
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
    public function edit($id_comment){
        //LA EDICION DE UN COMENTARIO ES SUPER CHOTA POR QUE NOS VA A
        //REDIRECCIONAR A UN MINIFORM EDIT, Y UNA VEZ HECHO EL UPDATE
        //SE REDIRECCIONA A RIDE SHOW
        $answer = Answer::find($id);
        return view('answer.edit')->with('answer', $answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_comment, $id_ride){
        //Validacion
        $this->validator($request->all())->validate();
        //Almacenamiento
        $answer = Answer::find($id);
        $answer->content = $request->content;
        $answer->save();

        $ride = Ride::find($ride_id);
        //Redireccion
        return view('ride.show')->with('success', 'Cambios guardados')->with('ride', $ride);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($answerId){
        $answer = Answer::find($answerId);
        $ride = Ride::find($answer->ride_id);
        
        Answer::destroy($answerId);
        
        return redirect()->route('ride.show', $ride->id);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'content' => 'required',
        ]);
    }

}
