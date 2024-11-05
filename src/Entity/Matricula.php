<?php

namespace App\Entity;

use App\Repository\MatriculaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatriculaRepository::class)]
class Matricula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'matriculas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Alumno $alumno = null;

    #[ORM\ManyToOne(inversedBy: 'matriculas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Asignatura $asignatura = null;

    #[ORM\Column(length: 9)]
    private ?string $curso = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAlumno(): ?Alumno
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumno $alumno): static
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getAsignatura(): ?Asignatura
    {
        return $this->asignatura;
    }

    public function setAsignatura(?Asignatura $asignatura): static
    {
        $this->asignatura = $asignatura;

        return $this;
    }

    public function getCurso(): ?string
    {
        return $this->curso;
    }

    public function setCurso(string $curso): static
    {
        $this->curso = $curso;

        return $this;
    }
}
