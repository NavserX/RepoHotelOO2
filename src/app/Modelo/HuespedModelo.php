<?php

namespace App\Modelo;



use App\Class\Huesped;
use PDO;
use PDOException;

class HuespedModelo
{

    public static function fromArray(array $datos): Huesped{
        return new Huesped(
            $datos['id'] ?? null,
            $datos['nombre'] ?? "Sin nombre",
            $datos['dni'] ?? "Sin DNI",
            $datos['vip'] ?? 0
        );
    }
    public static function obtenerTodos() :array{

        $conexion = null;
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=hotel_db", "examen", "examen");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "error al conectar con la base de datos".$e->getMessage();
        }
        $sql = "SELECT * FROM huespedes";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $resultado = [];
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            $resultado[] = self::fromArray($fila);
            }
        return $resultado;

    }

    public static function buscarHuesped(int $id): ?Huesped{
        try {
            $conexion = new PDO("mysql:host=mariadb;dbname=hotel_db", "examen", "examen");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "error al conectar con la base de datos".$e->getMessage();
        }
            $sql = "SELECT * FROM huespedes WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute(["id" => $id]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? self::fromArray($resultado):null;

        }

}