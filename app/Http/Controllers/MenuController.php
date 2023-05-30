<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
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
     * Almacene un plato recién creado en el almacenamiento.
     */
     public function store(Request $request)
     {
        try{
        
            $validatedData = $request->validate([
                'name' => ['required', 'regex:/[A-Za-z\s]+$/'],
                'ingredients' => ['required', 'regex:/[A-Za-z]+$/'],
                'id_section' => ['required'],
                'price' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            ]);

            $menu = new Menu();
            $menu->name = $request->input('name');
            $menu->price = $request->input('price');
            $menu->ingredients = $request->input('ingredients');
            $menu->id_section = $request->input('id_section');
            $menu->save();
        
            return response()->json([
                'error' => false,
                'message' => 'Receta creada exitosamente'
            ], 200);

        }catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error al crear la receta',
                'error_message' => $e->getMessage()
            ], 500);
        }
     }

     /**
     * Muestra los datos los platos que hay en el menu.
     */
    public function mostrar()
    {
        $datosPlatos = Menu::select('id','name', 'price','ingredients','id_section')->get();
        return $datosPlatos;
    }

    /**
     * Numero de platos por cada seccion
     */
    public function numPlatos()
    {
        $datosPlatos = DB::table('menus')
            ->join('sections', 'menus.id_section', '=', 'sections.id')
            ->select(DB::raw('count(*) as numPlatos'))
            ->groupBy('sections.id')
            ->get();

        return $datosPlatos;
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Modificar datos de un plato especifico.
     */
    public function update(Request $request, $id)
    {
        try {
            $receta = Menu::find($id);
            
            $receta->name = $request->input('name');
            $receta->ingredients = $request->input('ingredients');
            $receta->price = $request->input('price');
            $receta->id_section = $request->input('id_section');
            
            $receta->save();
    
            return response()->json([
                'error' => false,
                'message' => 'receta modificada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error al modificar la receta',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina un plato especifico
     */
    public function destroy($id)
    {
        try{
            $menu = Menu::find($id);
            $menu->delete();
            $recetas = Menu::select('id','name', 'price','ingredients','id_section')->get();

            return response()->json([
                'recetas' => $recetas,
                'error' => true,
                'message' => 'receta eliminada exitosamente'], 200);
        }catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => 'Error al eliminar la receta', 'error' => $e->getMessage()], 500);
        }
    }
}
