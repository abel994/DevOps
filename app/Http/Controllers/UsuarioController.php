<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller{

    public function index(){
        echo 'Controlador ususarios index';
    }

    public function show(Request $request){
        echo 'Controlador show usuarios';

        $parametro = $request->usuario;

        echo "<br> Tu nombre es $parametro";
    }

    public function test(){
        echo 'Desde test';

    }
}
