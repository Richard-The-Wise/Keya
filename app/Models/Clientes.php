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
        return $this->belongsTo(Paises::class,'pais_id');
    }

    public function estados(){
        return $this->belongsTo(Estado::class,'estado_id');
    }

    public function municipios(){
        return $this->belongsTo(Municipio::class,'municipio_id');
    }

    public function grupo_cliente(){
        return $this->belongsTo(GruposCliente::class,'grupo_cliente_id');
    }

    public function cliente_direcciones(){
        return $this->hasMany(ClienteDirecciones::class,'cliente_id');
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
