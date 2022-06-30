<?php

namespace\UsuarioControlers::class;
use Illuminate\Http\Request;

class UsuarioControlers extends Controller
{
   public function saludo ($name = null){
        return 'hola mijo ' . $name;
    }
}
