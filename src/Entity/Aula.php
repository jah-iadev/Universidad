<?php

namespace App\Entity;

use App\Repository\AulaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AulaRepository::class)]
class Aula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $ubicacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $capacidad = null;

    /**
     * @var Collection<int, Asignatura>
     */

    #[ORM\OneToMany(targetEntity: Asignatura::class, mappedBy: 'aula', cascade: ['persist', 'remove'])]
    private Collection $asignaturas;

    public function __construct()
    {
        $this->asignaturas = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): static
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(?int $capacidad): static
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getAsignaturas(): Collection
    {
        return $this->asignaturas;
    }

    public function addAsignatura(Asignatura $asignatura): self
    {
        if (!$this->asignaturas->contains($asignatura)) {
            $this->asignaturas->add($asignatura);
            $asignatura->setAula($this);
        }

        return $this;
    }

    public function removeAsignatura(Asignatura $asignatura): self
    {
        if ($this->asignaturas->removeElement($asignatura)) {
            // Si la asignatura está asociada a este aula, la desvincula
            if ($asignatura->getAula() === $this) {
                $asignatura->setAula(null);
            }
        }

        return $this;
    }
}