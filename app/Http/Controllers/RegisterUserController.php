<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showRegistrationForm()
{
    return view('auth.register');
}
    public function store(Request $request){
        $data = $request->all();
        \Log::info($request->all());
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
    
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            \Log::error('Error al registrar usuario: ' . $e->getMessage());
        return back()->withErrors(['error' => 'No se pudo registrar el usuario.']);
        }
    }
}
