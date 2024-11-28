<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $User=User::all();
        return view('auth.tabla',compact('User'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $User = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), 
        ]);
        auth()->login($User);
        return redirect()->route('dashboard')->with('success', 'Usuario registrado exitosamente.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_usuario)
    {
        $User=User::find($id_usuario);
        return view('auth.modal-info-ta'.compact('User'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_usuario)
    {
        $User=User::find($id_usuario);
        $User->name=$request->input('name');
        $User->email=$request->input('email');
        $User->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function showMostActiveUsers(){
        $mostActiveUsers = User::withCount('prestamos')
        ->orderBy('loans_count', 'desc')
        ->limit(5)
        ->get();
        foreach ($mostActiveUsers as $User) {
            echo $User->name. '-'.$User->loans_count. 'prestamos';
        }
    }
    public function usersWithPendingLoans(){
        $usersWithPendingLoans = User::whereHas('prestamos', function($query){
            $query->whereNull('returned_at');
        })->get();
        foreach ($usersWithPendingLoans as $User) {
            echo $User->name . ' tiene préstamos pendientes.';
        }
    }
}
