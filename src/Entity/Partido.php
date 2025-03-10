<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartidoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartidoRepository::class)]
#[ApiResource]
class Partido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $fecha = null;

    #[ORM\Column]
    private ?int $puntuacion1 = null;

    #[ORM\Column]
    private ?int $puntuacion2 = null;

    #[ORM\Column]
    private ?int $numJuegos1 = null;

    #[ORM\Column]
    private ?int $numJuegos2 = null;

    #[ORM\Column]
    private ?int $servicioActual = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notas = null;

    #[ORM\ManyToOne]
    private ?Socio $jugador1 = null;

    #[ORM\ManyToOne]
    private ?Socio $jugador2 = null;

    #[ORM\ManyToOne(inversedBy: 'partidos')]
    private ?Socio $juez = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeImmutable
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeImmutable $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPuntuacion1(): ?int
    {
        return $this->puntuacion1;
    }

    public function setPuntuacion1(int $puntuacion1): static
    {
        $this->puntuacion1 = $puntuacion1;

        return $this;
    }

    public function getPuntuacion2(): ?int
    {
        return $this->puntuacion2;
    }

    public function setPuntuacion2(int $puntuacion2): static
    {
        $this->puntuacion2 = $puntuacion2;

        return $this;
    }

    public function getNumJuegos1(): ?int
    {
        return $this->numJuegos1;
    }

    public function setNumJuegos1(int $numJuegos1): static
    {
        $this->numJuegos1 = $numJuegos1;

        return $this;
    }

    public function getNumJuegos2(): ?int
    {
        return $this->numJuegos2;
    }

    public function setNumJuegos2(int $numJuegos2): static
    {
        $this->numJuegos2 = $numJuegos2;

        return $this;
    }

    public function getServicioActual(): ?int
    {
        return $this->servicioActual;
    }

    public function setServicioActual(int $servicioActual): static
    {
        $this->servicioActual = $servicioActual;

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): static
    {
        $this->notas = $notas;

        return $this;
    }

    public function getJugador1(): ?Socio
    {
        return $this->jugador1;
    }

    public function setJugador1(?Socio $jugador1): static
    {
        $this->jugador1 = $jugador1;

        return $this;
    }

    public function getJugador2(): ?Socio
    {
        return $this->jugador2;
    }

    public function setJugador2(?Socio $jugador2): static
    {
        $this->jugador2 = $jugador2;

        return $this;
    }

    public function getJuez(): ?Socio
    {
        return $this->juez;
    }

    public function setJuez(?Socio $juez): static
    {
        $this->juez = $juez;

        return $this;
    }
}
