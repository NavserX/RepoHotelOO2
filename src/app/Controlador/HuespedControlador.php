<?php

namespace App\Controlador;

use App\Modelo\HuespedModelo;

class HuespedControlador
{

    public function listar(){
        $huespedes = HuespedModelo::obtenerTodos();
        header('Content-type: application/json; charset=utf-8');
        return json_encode($huespedes);
    }

    public function show(int $id){
        $huesped = HuespedModelo::buscarHuesped($id);
        header('Content-type: application/json; charset=utf-8');

        if(!$huesped){
            http_response_code(404);
            return json_encode(["error" => "Huesped no encontrado"]);
        }
        return json_encode([
            "msg" => "Huesped encontrado",
            "data" => $huesped
        ]);

    }

}