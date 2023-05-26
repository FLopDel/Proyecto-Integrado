<?php

namespace App\Http\Controllers;

use App\Models\Valoration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Validation;


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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => ['required', 'regex:/[A-Za-z]+$/'],
                'comments' => ['required', 'regex:/[A-Za-z0-9!.,]+$/'],
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
                'message' => 'Sección creada exitosamente'
            ], 200);

        }catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error al crear la sección',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }


    
    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function mostrar()
    {
        $valoracion = Valoration::select('id','name', 'comments','desactived','created_at')->where('desactived', 0)->orderByDesc('created_at')->get();
        return $valoracion;
    }

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
     * Remove the specified resource from storage.
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
