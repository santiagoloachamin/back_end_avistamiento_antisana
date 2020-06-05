<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avistamiento extends Model
{

    protected $table = 'avistamientos';
    
    protected $fillable = [ 
        'user_id', 'titulo', 'descripcion', 'url_imagen','lat','lng','estado'
     ];

}

