<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'municipios';
     protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = ['id','estado_id','nombre','pais_id'];
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
    public function estados(){
        return $this->belongsTo(Estado::class,'estado_id','id');
    }

    public function paises(){
        return $this->belongsTo(Paises::class,'pais_id','id');
    }

    public function clientes(){
        $this->belongsTo(Clientes::class,'id','estado_id');
    }

    public function cliente_direcciones(){
        $this->belongsTo(ClienteDirecciones::class,'municipio_id','municipio_id');
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
