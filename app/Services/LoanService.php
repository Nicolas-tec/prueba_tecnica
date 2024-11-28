<?php

namespace App\Services;

use App\Models\prestamos;
use App\Models\libros;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoanService
{
    /**
     * Crear un nuevo préstamo.
     *
     * @param User $User
     * @param libros $libros
     * @return prestamos
     * @throws \Exception
     */
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function createLoan(user $User, book $libros){
        if ($libros->quantity <= 0) {
            throw new \Exception('El libro no está disponible');
        }
        DB::beginTransaction();
        try {
            if (!$libros->isAvailable()) {
                throw new \Exception('El libro no está disponible');
            }
            $libros->reduceStock();
            $prestamos = prestamos::create([
                'id_libro' => $libros->id_libro,
                'id_ususario' => $User->id_ususario,
                'fecha_salida' => now(),
                'fecha_devolucion' => now()->addDays(14),
            ]);
            DB::commit();
            return $prestamos;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function returnLoan(prestamos $prestamos){
        DB::beginTransaction();
        try {
            $prestamos->libros->increaseStock();
            $prestamos->update(['returned_at' => now()]);
            DB::commit();
            return $prestamos;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
