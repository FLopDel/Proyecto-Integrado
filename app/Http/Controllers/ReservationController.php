<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Reservation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // importa la clase DB
use App\Mail\ReservaMail;
use Illuminate\Support\Facades\Mail;


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
     * Almacene una reserva recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
    
            $userId = Auth::id();
            $user = User::find($userId);

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
                

            if ((intval($sumPeople) + $people) <= 100 && (!$reservationExists) && ($validatedData['date'] >= now()->toDateString())){
                $reservation = new Reservation;
                $reservation->id_user = $userId;
                $reservation->phone = $request->input('phone');
                $reservation->people = $people;
                $reservation->date = $date;
                $reservation->time = $time;
                            
                $reservation->save();
            
                $reservaMail = new ReservaMail($user->name, $user->last_name, $user->email, $reservation->phone, $reservation->people, $reservation->date, $reservation->time);
                Mail::to($user->email)->send($reservaMail);
                
                return response()->json([
                    'date' => false,
                    'msg' => 'Reserva correcta',
                ]);
            } else {
                return response()->json(
                [
                    'fecha' => true,
                    'error' => true,
                    'aforo' => true,
                    'msg' => 'Ya ha reservado o se ha alcanzado el límite de personas',
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
     * Muestra todos los datos de las reservas
     */
    public function mostrar()
    {
        $comentarios = Reservation::with('user')->select('id_user', 'phone', 'date', 'time')->get();
        return $comentarios;
    }
    /**
     * Muestra todos la fecha de las reservas
     */
    public function fecha()
    {
        $comentarios = Reservation::select('id','date')->get();
        return $comentarios;
    }

    /**
     * Muestra el numero de reservas que hay por fecha
     */
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
