<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Storage;


class SectionController extends Controller
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
     * Almacene una seccion recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        try{

            $validatedData = $request->validate([
                'title' => ['required', 'regex:/^[A-Za-z]+$/'],
                'subtitle' => ['required', 'regex:/^[A-Za-z]+$/'],
                'imagen' => ['required'],
            ]);

            $section = new Section();
            $section->title = $request->input('title');
            $section->subtitle = $request->input('subtitle');
            $section->imagen = $request->file('imagen')->getClientOriginalName();
            $section->save();
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                Storage::build(storage_path("/secciones"))->put($section->imagen, file_get_contents($imagen));
    
                return response()->json([
                    'error' => false,
                    'message' => 'Sección creada exitosamente'
                ], 200);
            }    
        }catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error al crear la sección',
                'error_message' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Muestra los datos de todas las secciones.
     */
    public function mostrar()
    {
        $secciones = Section::select('id', 'title','subtitle','imagen')->get();
        return $secciones;
    }

    /**
     * Muesytra solamente los titulos de las secciones
     */
    public function secciones()
    {
        $tituloSecciones = Section::select('id','title')->get();
        return $tituloSecciones;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Modifica una seccion especifica
     */
    public function update(Request $request, $id)
    {
        try {
            
            $seccion = Section::find($id);
            $seccion->title = $request->input('title');
            $seccion->subtitle = $request->input('subtitle');
            
            if ($request->hasFile('imagen')) {
                // Eliminar imagen existente
                if ($seccion->imagen) {
                    $rutaImagen = storage_path('secciones/' . $seccion->imagen);
                    if (file_exists($rutaImagen)) {
                        unlink($rutaImagen);
                    }
                }
                
                // Guardar nueva imagen
                $imagen = $request->file('imagen');
                $imageName = $imagen->getClientOriginalName();
                $seccion->imagen = $imageName;
                Storage::build(storage_path("/secciones"))->put($seccion->imagen, file_get_contents($imagen));
            }
            
            $seccion->save();
            $secciones = Section::select('id', 'title','subtitle','imagen')->get();

            return response()->json([
                'secciones' => $secciones,
                'error' => false,
                'message' => 'Sección modificada exitosamente'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error al modificar la sección',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Elimina una seccion especifica.
     */
    public function destroy(Request $request, $id)
    {
        try{
            $seccion = Section::find($id);
            // Eliminar imagen existente        

            if ($seccion->imagen) {
                $rutaImagen = storage_path('secciones/' . $seccion->imagen);
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }
            
            $seccion->delete();
            $secciones = Section::select('id', 'title','subtitle','imagen')->get();

            return response()->json([
                'secciones' => $secciones,
                'error' => true,
                'message' => 'Seccion eliminada exitosamente',], 200);
        }catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => 'Error al eliminar la seccion', 'error' => $e->getMessage()], 500);
        }
    }
}
