<?php namespace App\Controllers;

class HolaMundo extends BaseController {
    public function index() {
        $datos["llave1"] = "dato 1 desdse index";
        return view('vista_hola_mundo', $datos);
    }
    public function desdeSbuCarpeta() {
        $datos["llave1"] = "dato 1";
        return view('vista_hola_mundo', $datos);
    }
}
