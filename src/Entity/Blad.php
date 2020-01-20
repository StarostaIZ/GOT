<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BladRepository")
 * @ORM\Table(name="Bledy")
 */
class Blad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temat;

    /**
     * @ORM\Column(type="text")
     */
    private $tresc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turysta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kategoria;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemat(): ?string
    {
        return $this->temat;
    }

    public function setTemat(string $temat): self
    {
        $this->temat = $temat;

        return $this;
    }

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    public function setTresc(string $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }

    public function getAutor(): ?Turysta
    {
        return $this->autor;
    }

    public function setAutor(?Turysta $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getKategoria(): ?string
    {
        return $this->kategoria;
    }

    public function setKategoria(string $kategoria): self
    {
        $this->kategoria = $kategoria;

        return $this;
    }
}
