<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {

        $validacion = Validator::make($request->all(), [
            'username'  => 'required|min:5|max:20',
            'email'     => 'required|email|max:50|unique:users',
            'password'  => 'required|min:4|max:12',
        ]);
 
        if ($validacion->fails()) {
            return response()->json([
                'error'=>$validacion->errors()
            ], 401);
        }



        $input              = $request->all();
        $input['password']  = $input['password'];

        $data = User::create($input);
 
    
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


     public function login(Request $request) {

        $validacion = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:16',
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'error'=>$validacion->errors()
            ], 401);
        }
 
        $input              = $request->all();
        $data = User::All()->where('email', $input['email'])
                            ->where('password', $input['password']);

       
            
                    if ( count($data) === 0 ){

                        return response()->json([
                            'success' => [
                                "data"  =>  $data,
                                'mensaje'   =>'Correo Ó contraseña incorrecta, Reintente!',
                                'estatus'   => 401
                            ],
                            'error'   => []
                        ], 200 ); 
                    }
                    

        return response()->json([
            'success' => [
                "data"  =>  $data,
                'mensaje'   =>'Bienvenido',
                'estatus'   => 200
            ],
            'error'   => []
        ], 200 );   
        
        
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
