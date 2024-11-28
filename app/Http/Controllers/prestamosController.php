<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\prestamos;
use Illuminate\Support\Facades\DB;
use App\Models\libros;
use App\Models\User;
use App\Services\LoanService;

class prestamosController extends Controller
{
    protected $LoanService;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos=prestamos::all();
        return view('prestamos.prestamos',compact('prestamos'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $request->validate([
            'id_ususario' => 'required|exists:usuario,id_ususario',
            'id_libro' => 'required|exists:libros,id_libro',
        ]);
        $User = User::findOrFail($request->id_ususario);
        $libros = libro::findOrFail($request->id_libro);
        if (!$libros->isAvailable()) {
            return response()->json(['error' => 'El libro no está disponible'], 400);
        }
        try {
            $prestamos = $this->LoanService->createLoan($User, $libros);
            return response()->json(['prestamos' => $prestamos], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prestamos= new prestamos;
        $prestamos->id_libro=$request->input('id_libro');
        $prestamos->id_ususario=$request->input('id_ususario');
        $prestamos->fecha_salida=$request->input('fecha_salida');
        $prestamos->fecha_devolucion=$request->input('fecha_devolucion');
        $prestamos->save();
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
    public function edit($id_prestamo)
    {
        $prestamos=prestamo::find($id_prestamo);
        return view('prestamos.model-info-pre',compact('prestamos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_prestamo)
    {
        $prestamos = prestamos::find($id_prestamo);
        $prestamos->id_libro=$request->input('id_libro');
        $prestamos->id_ususario=$request->input('id_ususario');
        $prestamos->fecha_salida=$request->input('fecha_salida');
        $prestamos->fecha_devolucion=$request->input('fecha_devolucion');
        $prestamos->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_prestamo)
    {
        $prestamos=prestamos::find($id_prestamo);
        $prestamos->delete();
        return redirect()->back();
    }
    public function loansPerMonth(){
        $loansPerMonth = prestamos::select(DB::raw('MONTH(borrowed_at) as month'), DB::raw('COUNT(*) as total_loans'))
        ->groupBy(DB::raw('MONTH(borrowed_at)'))
        ->orderBy('month', 'asc')
        ->get();
        foreach ($loansPerMonth as $prestamos) {
            echo 'mes' . $prestamos->month . ': '.$prestamos->total_loans . 'prestamos';
        }
    }
    public function __construct(LoanService $LoanService){
        $this->LoanService = $LoanService;
    }
    public function createLoan(Request $request){
        $request->validate([
            'id_ususario' => 'required|exists:usuario,id_ususario',
            'id_libro' =>'required|exists:libros,id_libro',
        ]);
        $User = User::findOrFail($request->id_ususario);
        $libros = libros::findOrFail($request->id_libro);
        try {
            $prestamos = $this->LoanService->createLoan($User, $libros);
            return response()->json(['message' => 'Préstamo creado con éxito', 'prestamos' => $prestamos], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function returnLoan(Request $request, $id_prestamo){
        $prestamos = prestamos::findOrFail($id_prestamo);
        if ($prestamos->returned_at) {
            return response()->json(['error' => 'El préstamo ya ha sido devuelto'], 400);
        }
        try {
            $this->LoanService->returnLoan($prestamos);
            return response()->json(['message' => 'Préstamo devuelto con éxito', 'prestamos' => $prestamos], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
