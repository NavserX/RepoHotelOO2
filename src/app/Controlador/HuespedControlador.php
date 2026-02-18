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

    public function crear() {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);

        if (isset($datos['nombre'], $datos['dni'], $datos['email'])) {
            $nuevoHuesped = new \App\Class\Huesped(
                0,
                $datos['nombre'],
                $datos['dni'],
                $datos['email'],
                (bool)($datos['vip'] ?? false)
            );

            if (\App\Modelo\HuespedModelo::guardarHuesped($nuevoHuesped)) {
                header('Content-type: application/json; charset=utf-8');
                http_response_code(201);
                echo json_encode(["mensaje" => "Huésped creado con éxito"], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["error" => "Error de base de datos"]);
            }
        } else {
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }

}