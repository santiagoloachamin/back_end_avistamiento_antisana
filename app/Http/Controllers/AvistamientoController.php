<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avistamiento;
use Validator;

class AvistamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Avistamiento::All(); 
        
            if ( count( $data )  === 0  ){
                return response()->json([
                    'success' => [
                        "data"  =>  $data,
                        'mensaje'   =>'No existe información para mostrar',
                        'estatus'   => 200
                    ],
                    'error'   => []
                ], 200 ); 
            }
       
        return response()->json([
            'success' => [
                "data"  =>  $data,
                'mensaje'   =>'Lista de avistamientos',
                'estatus'   => 200
            ],
            'error'   => []
        ], 200 );
    }
    
    public function user_index()
    {
        $data = Avistamiento::All()->where('estado','=', 'APROBADO'); 
        


            if ( count( $data )  === 0  ) {
                return response()->json([
                    'success' => [
                        "data"  =>  $data,
                        'mensaje'   =>'No existe información para mostrar',
                        'estatus'   => 200
                    ],
                    'error'   => []
                ], 200 ); 
            }
       
        return response()->json([
            'success' => [
                "data"  =>  $data,
                'mensaje'   =>'Lista de avistamientos',
                'estatus'   => 200
            ],
            'error'   => []
        ], 200 );
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        $validacion = Validator::make($request->all(), [
            'user_id'   => 'required',
            'titulo'    => 'required|min:5|max:15',
            'url_imagen'=> 'required',
            'descripcion'=> 'required',
            'lat'       => 'required',
            'lng'       => 'required',
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'error'=>$validacion->errors ()
            ], 401);
        }

        $input              = $request->all();
        $input['estado']    = 'PENDIENTE';


        
        if ($request->hasFile('url_imagen')) {
            $file                   = $request->file('url_imagen');
            $input['url_imagen']    = time().$file->getClientOriginalName();
            $file->move(public_path() . '/imagenes/', $input['url_imagen']);
        }
    
        
    
                        $data = Avistamiento::create($input);
            
                    
                        if ( empty( $data )  === 0  ){
                            return response()->json([
                                'success' => [
                                    "data"  =>  $data,
                                    'mensaje'   =>'No fue posible registrar, Reintente!',
                                    'estatus'   => 200
                                ],
                                'error'   => []
                            ], 200 ); 
                        }




                return response()->json([
                    'success' => [
                        "data"  =>  $data,
                        'mensaje'   =>'Su registro fue exitoso',
                        'estatus'   => 200
                    ],
                    'error'   => []
                ], 200 );



    }

 
   

     
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request)
    {

        $validacion = Validator::make($request->all(), [
            'avistamiento_id'   => 'required',
            'estado'            => 'required',
        ]);


        if ($validacion->fails()) {
            return response()->json([
                'error'=>$validacion->errors ()
            ], 401);
        }

        $input              = $request->all();
 
        Avistamiento::where('id','=',$input['avistamiento_id'])
            ->update([
                 "estado"    =>  $input['estado']
            ]);


        return response()->json([
            'success' => [
                "data"  =>  $input,
                'mensaje'   =>'Su registro fue '.$input['estado'],
                'estatus'   => 200
            ],
            'error'   => []
        ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
