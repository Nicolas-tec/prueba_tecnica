<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;
use Illuminate\Support\Facades\DB;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria=categoria::all();
        return view('categoria.categoria', compact('categoria'));
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
        $categoria=new categoria;
        $categoria->categoria=$request->input('categoria');
        $categoria->save();
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
    public function edit($id_categoria)
    {
        $categoria=categoria::find($id_categoria);
        return view('categoria.modal-info-ca'.compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_categoria)
    {
        $categoria=categoria::find($id_categoria);
        $categoria->categoria=$request->input('categoria');
        $categoria->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function loansByCategory(){
        $loansByCategory = categoria::withCount(['libros' => function($query){
            $query->whereHas('prestamos');
        }])->get();
        foreach ($loansByCategory as $categoria) {
            echo $categoria->name. '-'. $categoria->books_count . 'prestamos';       
        }
    }
}
