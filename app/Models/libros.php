<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class libros extends Model
{
    use HasFactory;
    protected $table = 'libros';
    protected $primaryKey = 'id_libro';
    public $timestamps = false;
    protected $guarded=[];
    protected $fillable = [
        'id_categoria',
        'titulo',
        'sub_titulo',
        'pagina',
        'ISBN',
        'editorial',
        'autor'
    ];
    public function categoria(){
        return $this->belongsTo(categoria::class);
    }
    public function prestamos(){
        return $this->hasMany(prestamos::class);
    }
    public function reduceStock($quantity = 1){
        if ($this->quantity < $quantity) {
            throw new \Exception("Stock insuficiente para el libro: {$this->title}");
        }
        $this->quantity -= $quantity;
        $this->save();
    }
    public function increaseStock($quantity = 1){
        $this->quantity += $quantity;
        $this->save();
    }
    public function isAvailable(): libros{
        return $this->quantity > 0;
    }
}
