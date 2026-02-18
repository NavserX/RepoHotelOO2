<?php

namespace App\Modelo;



use App\Class\Huesped;
use PDO;
use PDOException;

class HuespedModelo
{

    public static function fromArray(array $datos): Huesped{
        return new Huesped(
            (int)$datos['id'] ?? 0,
            (string)$datos['nombre'] ?? "Sin nombre",
            (string)$datos['dni'] ?? "Sin DNI",
            (string)$datos['email'] ?? "Sin email",
            (bool)$datos['vip'] ?? false
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

    public static function guardarHuesped(Huesped $h): bool {
        try {
            $conexion = new \PDO("mysql:host=mariadb;dbname=hotel_db", "examen", "examen");
            $sql = "INSERT INTO huespedes (nombre, dni, email, vip) VALUES (:nombre, :dni, :email, :vip)";
            $stmt = $conexion->prepare($sql);
            return $stmt->execute([
                'nombre' => $h->getNombre(),
                'dni' => $h->getDni(),
                'email'  => $h->getEmail(),
                'vip' => $h->isVip() ? 1 : 0
            ]);
        } catch (\PDOException $e) {
            return false;
        }
    }

}