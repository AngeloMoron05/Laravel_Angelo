<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Cliente;

class ControladorCliente extends Controller
{
    public function lista(){
        $clientes = Cliente::all();

        if ($clientes->isEmpty()){
            $data = [
                'mensaje' => 'No se encontraron clientes',
                'estado' => 200
            ];
            return response() ->json($data,204);
        };
        return response() -> json($clientes,200);
    }

    public function crear(Request $request){
        $validador = Validator::make($request->all(),[
            'nombre' => 'required | max:255',
            'correo' => 'required | email',
            'telefono' => 'required'
        ]);

        if ($validador->fails()){
            $data = [
                'mensaje' => 'Error en la validación de datos',
                'errores' => $validador ->errors(),
                'estado' => 400
            ];
            return response() ->json($data,400);
        }

        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono
        ]);

        if (!$cliente){
            $data = [
                'mensaje' => 'Error al crear el cliente',
                'estado' => 500
            ];
            return response() -> json($data,500);
        }
        $data = [
            'Cliente' => $cliente,
            'estado' => 201
        ];
        return response() -> json($data,200);
    }

    public function cliente($id){
        $cliente = Cliente::find($id);
        if (!$cliente) {
            $data = [
                'mensaje' => 'Cliente no encontrado',
                'estado' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($cliente, 200);
    }

    public function actualizar(Request $request, $id){
        $cliente = Cliente::find($id);

        if (!$cliente){
            $data = [
                'mensaje' => 'Cliente no encontrado',
                'estado' => 404
            ];
            return response() -> json($data,404);
        }

        $validador = Validator::make($request->all(),[
            'nombre' => 'required | max:255',
            'correo' => 'required | email',
            'telefono' => 'required'
        ]);
    
        if ($validador->fails()){
            $data = [
                'mensaje' => 'Error en la validación de datos',
                'errores' => $validador ->errors(),
                'estado' => 400
            ];
            return response() ->json($data,400);
        }

        $cliente -> nombre = $request->nombre;
        $cliente -> correo = $request->correo;
        $cliente -> telefono = $request->telefono;

        $cliente -> save();

        $data = [
            'Mensaje' => 'Cliente Actualizado',
            'Cliente' => $cliente,
            'Estado' => 200
        ];

        return response() -> json($data,200);
    }

    public function eliminar($id){
        $cliente = Cliente::find($id);
        if (!$cliente) {
            $data = [
                'mensaje' => 'Cliente no encontrado',
                'estado' => 404
            ];
            return response()->json($data, 404);
        }
        $cliente->delete();
        $data = [
            'mensaje' => 'Cliente eliminado correctamente',
            'estado' => 200
        ];
        return response()->json($data);
    }

    public function modificar(Request $request, $id){
        $cliente = Cliente::find($id);

        if (!$cliente){
            $data = [
                'mensaje' => 'Cliente no encontrado',
                'estado' => 404
            ];
            return response() -> json($data,404);
        }

        $validador = Validator::make($request->all(),[
            'nombre' => 'max:255',
            'correo' => 'email',
            'telefono' => 'max:255'
        ]);
    
        if ($validador->fails()){
            $data = [
                'mensaje' => 'Error en la validación de datos',
                'errores' => $validador ->errors(),
                'estado' => 400
            ];
            return response() ->json($data,400);
        }

        if($request -> has ('nombre')){
            $cliente -> nombre = $request -> nombre;
        }
        if($request -> has ('correo')){
            $cliente -> correo = $request -> correo;
        }
        if($request -> has ('telefono')){
            $cliente -> telefono = $request -> telefono;
        }
        $cliente -> save();

        $data = [
            'Mensaje' => 'Cliente Actualizado',
            'Cliente' => $cliente,
            'Estado' => 200
        ];

        return response() -> json($data,200);
    }
}
