<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
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
     * Almacene un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {        
        if(Auth::check()){
            $userId = Auth::id();

            $validatedData = $request->validate([
                'name' => ['required', 'regex:/[A-Za-z]+$/'],
                'title' => ['required', 'regex:/^[A-Za-z\s]+$/'],
                'message' => ['required', 'regex:/[A-Za-z0-9!.,]+$/'],
            ]);

            $blog = new Blog();
            // $blog->id = $userId;
            $blog->name = $request->input('name');
            $blog->title = $request->input('title');
            $blog->imagen = $request->file('imagen')->getClientOriginalName();
            $blog->date = $request->input('date');
            $blog->message = $request->input('message');

            $blog->save();
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                Storage::build(storage_path("/blog"))->put($blog->imagen, file_get_contents($imagen));

                $blogs = Blog::select('id', 'name','title','date','message','imagen')->get();
                return response()->json([
                    'comentarios' => $blogs,
                    'error' => false,
                    'msg' => 'Noticia realizada correctamente',
                ]);
            }
        }else{
            return response()->json([
                'error' => true,
                'msg' => 'Necesitas estar registrado',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Muestra todas las noticias
     */
    public function mostrar()
    {
        $blogs = Blog::select('id', 'name','title','date','message','imagen')->get();
        return $blogs;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Eliminar un noticia especifica
     */
    public function destroy($id)
    {
        try{
            $seccion = Blog::find($id);
            // Eliminar imagen existente
            if ($seccion->imagen) {
                $rutaImagen = storage_path('blog/' . $seccion->imagen);
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }
            $seccion->delete();
            $noticias = Blog::select('id', 'name','title','date','message','imagen')->get();

            return response()->json([
                'noticias' => $noticias,
                'error' => true,
                'message' => 'Noticia eliminada exitosamente',], 200);
        }catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => 'Error al eliminar la notica', 'error' => $e->getMessage()], 500);
        }
    }
}
