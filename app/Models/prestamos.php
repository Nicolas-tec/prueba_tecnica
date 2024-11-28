<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class prestamos extends Model
{
    use HasFactory;
    protected $table = 'prestamos';
    protected $primaryKey = 'id_prestamo';
    public $timestamps = false;
    protected $guarded=[];
    protected $fillable = [
        'id_libro',
        'id_ususario',
        'id_categoria',
        'fecha_salida',
        'fecha_devolucion',
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function libro(){
        return $this->belongsTo(libro::class);
    }
}
