<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Coche extends Model
{
    use SoftDeletes;

    protected $table = 'coches';

    // protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['marca', 'modelo', 'motor', 'potencia']; 


            // $table->bigIncrements('id');
            // $table->string('marca');
            // $table->string('modelo');
            // $table->string('motor');
            // $table->bigInteger('potencia');
            // $table->timestamps();
}

