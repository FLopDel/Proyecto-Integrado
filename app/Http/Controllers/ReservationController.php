<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // importa la clase DB


class ReservationController extends Controller
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
        if (Auth::check()) {
    
            $userId = Auth::id();

            $validatedData = $request->validate([
                'phone' => ['required', 'regex:/[0-9]{9}$/'],
                'people' => ['required', 'numeric', 'between:2,12'],
                'date' => ['required'],
                'time' => ['required'],
            ]);
            $people = $request->input('people');
            $date = $request->input('date');
            $time = $request->input('time');


            $sumPeople = Reservation::whereDate('date', $date)->sum('people');
            $reservationExists = Reservation::where('id_user', $userId)
                ->where('date', $date)
                ->where('time', $time)
                ->exists();
                        

            if ((intval($sumPeople) + $people) <= 100 && (!$reservationExists)){
                $reservation = new Reservation;
                $reservation->id_user = $userId;
                $reservation->phone = $request->input('phone');
                $reservation->people = $people;
                $reservation->date = $date;
                $reservation->time = $time;
                            
                $reservation->save();
            
                return response()->json([
                    'error' => false,
                    'msg' => 'Reserva correcta',
                ]);
            } else {
                return response()->json(
                [
                    'error' => true,
                    'aforo' => true,
                    'msg' => 'La reserva ya existe o se ha alcanzado el límite de personas',
                ]);
            }
                
        }else{
            return response()->json([
                'registro' => true,
                'msg' => 'Debe de registrarse',
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function mostrar()
    {
        $comentarios = Reservation::with('user')->select('id_user', 'phone', 'date', 'time')->get();
        return $comentarios;
    }

    public function fecha()
    {
        $comentarios = Reservation::select('id','date')->get();
        return $comentarios;
    }

    // public function numsRegistros()
    // {
    //     $numRegistros = DB::table('reservations')
    //         ->select(DB::raw('date, count(*) as numRegistros'))
    //         ->groupBy('date')
    //         ->get();
    //     return $numRegistros;
    // }

    public function numReservas()
    {
        $fechaInicio = Carbon::now()->addDays(7)->format('Y-m-d');
        $numReservas = Reservation::select('date', DB::raw('count(*) as count'))
            ->where('date', '<=', $fechaInicio)
            ->groupBy('date')
            ->get();
        return $numReservas;
    }


    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
