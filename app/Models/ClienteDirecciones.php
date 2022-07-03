<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ClienteDirecciones extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'cliente_direcciones';
     protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = ['id','cliente_id','pais_id','estado_id','municipio_id','estatus','tipo','nombre','calle','numero_exterior','numero_interior','colonia','codigo_postal'];
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
    public function cliente(){
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    public function paises(){
        return $this->hasOne(Paises::class,'pais_id','id');
    }

    public function estados(){
        return $this->hasOne(Estado::class,'estado_id','id');
    }

    public function municipios(){
        return $this->hasOne(Municipio::class, 'municipio_id', 'id');
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
