<?php

namespace App\Entity;

use App\Repository\AsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsignaturaRepository::class)]
class Asignatura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $creditos = null;

    /**
     * @var Collection<int, Matricula>
     */
    #[ORM\OneToMany(targetEntity: Matricula::class, mappedBy: 'alumno')]
    private Collection $matriculas;

    #[ORM\ManyToOne(targetEntity: Aula::class, inversedBy: 'asignaturas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aula $aula = null;


    public function __construct()
    {
        $this->matriculas = new ArrayCollection();
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

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(int $creditos): static
    {
        $this->creditos = $creditos;

        return $this;
    }

    public function getAula(): ?Aula
    {
        return $this->aula;
    }

    public function setAula(?Aula $aula): self
    {
        $this->aula = $aula;

        return $this;
    }

    /**
     * @return Collection<int, Matricula>
     */
    public function getMatriculas(): Collection
    {
        return $this->matriculas;
    }

    public function addMatricula(Matricula $matricula): static
    {
        if (!$this->matriculas->contains($matricula)) {
            $this->matriculas->add($matricula);
            $matricula->setAsignatura($this);
        }

        return $this;
    }

    public function removeMatricula(Matricula $matricula): static
    {
        if ($this->matriculas->removeElement($matricula)) {
            // set the owning side to null (unless already changed)
            if ($matricula->getAsignatura() === $this) {
                $matricula->setAsignatura(null);
            }
        }

        return $this;
    }
}
