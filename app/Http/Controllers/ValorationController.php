<?php

namespace App\Http\Controllers;

use App\Models\Valoration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Auth;


class ValorationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Almacene una valoracion recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        if(Auth::check()){

            try{
                $validatedData = $request->validate([
                    'name' => ['required', 'regex:/[A-Za-záéíóúñÁÉÍÓÚÑ\s]+$/'],
                    'comments' => ['required', 'regex:/[A-Za-z0-9áéíóúñÁÉÍÓÚÑ,.\s]+$/'],
                ]);

                $datosComentario = new Valoration();
                $datosComentario->name = $request->input('name');
                $datosComentario->comments = $request->input('comments');
                $datosComentario->desactived = 0;
                $datosComentario->save();
                $comentarios = Valoration::select('id','name', 'comments','created_at')->where('desactived', 0)->orderByDesc('created_at')->get();

                return response()->json([
                    'comentarios' => $comentarios,
                    'error' => false,
                    'message' => 'Comentario creada exitosamente'
                ], 200);

            }catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'message' => 'Error al crear el comentario',
                    'error_message' => $e->getMessage()
                ], 500);
            }
        }else{
            return response()->json([
                'logeado' => true,
                'msg' => 'Necesitas estar registrado',
            ]);
        }
    }


    
    /**
     * Inhabilita la visualizacion de una valoracion.
     */
    public function desactived($id)
    {
        try{
            $comentario = Valoration::find($id);
            $comentario->desactived = 1;
            $comentario->save();
            $comentarios = Valoration::select('id','name', 'comments','created_at')->where('desactived', 0)->orderByDesc('created_at')->get();

            return response()->json([
                'comentarios' => $comentarios,
                'error' => true,
                'message' => 'Comentario inhabilitado exitosamente'], 200);
        }catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => 'Error al inhabilitar el comentario', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Muestra todas las valoraciones visibles ordenadas
     */
    public function mostrar()
    {
        $valoracion = Valoration::select('id','name', 'comments','desactived','created_at')->where('desactived', 0)->orderByDesc('created_at')->get();
        return $valoracion;
    }
    /**
     * Muestra todas las valoraciones
     */
    public function mostrarTodos()
    {
        $valoracion = Valoration::select('id','name', 'comments','desactived','created_at')->get();
        return $valoracion;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valoration $valoration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Valoration $valoration)
    {
        //
    }

    /**
     * Elimina una valoracion especifica.
     */
    public function destroy($id)
    {
        try{
            
            $comentario = Valoration::find($id);
            $comentario->delete();
            $comentarios = Valoration::select('id','name', 'comments','created_at')->where('desactived', 0)->orderByDesc('created_at')->get();

            return response()->json([
                'comentarios' => $comentarios,
                'error' => true,
                'message' => 'Comentario eliminado exitosamente'], 200);
        }catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => 'Error al eliminar el comentario', 'error' => $e->getMessage()], 500);
        }
    } 
}
