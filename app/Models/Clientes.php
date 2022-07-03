<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'clientes';
     protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = ['id','pais_id','estado_id','municipio_id','nombre_comercial','razon_social','email','calle','numero_exterior','numero_interior','colonia','estatus','grupo_cliente_id','codigo_postal'];
    // protected $hidden = [];
     protected $dates = ['created_at','updated_at','deleted_at'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function paises(){
        return $this->hasOne(Paises::class,'pais_id','id');
    }

    public function estados(){
        return $this->hasOne(Estado::class,'estado_id','id');
    }

    public function municipios(){
        return $this->hasOne(Municipio::class,'municipio_id','id');
    }

    public function grupo_cliente(){
        return $this->belongsTo(GruposCliente::class,'grupo_cliente_id','id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
