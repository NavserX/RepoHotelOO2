<?php

namespace App\Class;

class Huesped implements \JsonSerializable
{

    /**
     * @inheritDoc
     */
    private int $id;
    private string $nombre;
    private string $dni;
    private bool $vip;

    /**
     * @param int $id
     * @param string $nombre
     * @param string $dni
     * @param bool $vip
     */
    public function __construct(int $id, string $nombre, string $dni, bool $vip)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->vip = $vip;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Huesped
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Huesped
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): Huesped
    {
        $this->dni = $dni;
        return $this;
    }

    public function isVip(): bool
    {
        return $this->vip;
    }

    public function setVip(bool $vip): Huesped
    {
        $this->vip = $vip;
        return $this;
    }



    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'dni' => $this->dni,
            'vip' => $this->vip
        ];
    }
}