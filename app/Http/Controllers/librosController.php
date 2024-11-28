<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libros;
use App\Models\prestamos;

class librosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros=libros::all();
        return view('libros.libros',compact('libros'));
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
        $libros= new libros;
        $libros->id_categoria=$request->input('id_categoria');
        $libros->titulo=$request->input('titulo');
        $libros->sub_titulo=$request->input('sub_titulo');
        $libros->pagina=$request->input('pagina');
        $libros->ISBN=$request->input('ISBN');
        $libros->editorial=$request->input('editorial');
        $libros->autor=$request->input('autor');
        $libros->save();
        return redirect()->back();
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
    public function edit($id_libro)
    {
        $libros=libro::find($id_libro);
        return view('libros.modal-info-li',compact('libros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_libro)
    {
        $libros=libros::find($id_libro);
        $libros->id_categoria=$request->input('id_categoria');
        $libros->titulo=$request->input('titulo');
        $libros->sub_titulo=$request->input('sub_titulo');
        $libros->pagina=$request->input('pagina');
        $libros->ISBN=$request->input('ISBN');
        $libros->editorial=$request->input('editorial');
        $libros->autor=$request->input('autor');
        $libros->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_libro)
    {
        $libros=libros::find($id_libro);
        $libros->delete();
        return redirect()->back();
    }
    
    public function showMostPopularBooks(){
        $mostPopularBooks = libros::withCount('prestamos')
        ->orderBy('loans_count', 'desc')
        ->limit(5)
        ->get();
        foreach ($mostPopularBooks as $libros) {
            echo $libros->title . ' - ' . $libros->loans_count . ' prestamos';
        }
    }
    public function leastPopularBooks(){
        $leastPopularBooks = libros::withCount('prestamos')
        ->orderBy('loans_count', 'asc')
        ->limit(5)
        ->get();
        foreach ($leastPopularBooks as $libros) {
            echo $libros->title. '-' . $libros->loans_count . 'prestamos';
        }
    }
}