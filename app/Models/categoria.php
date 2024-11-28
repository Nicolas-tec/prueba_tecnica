<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    protected $guarded=[];
    public $timestamps = false;
    protected $fillable =['categoria'];
    public function libros(){
        return $this->hasMany(libros::class);
    }
}
