<?php

namespace App\Class;

class Habitacion implements \JsonSerializable
{

    /**
     * @inheritDoc
     */

    private int $id;
    private string $numero;
    private float $precio;

    /**
     * @param int $id
     * @param string $numero
     * @param float $precio
     */
    public function __construct(int $id, string $numero, float $precio)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Habitacion
    {
        $this->id = $id;
        return $this;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): Habitacion
    {
        $this->numero = $numero;
        return $this;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): Habitacion
    {
        $this->precio = $precio;
        return $this;
    }


    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}