<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa opisujące strukturę błędu, który może zgłosić Tursyta w celu
 * polepszenia jakości świadczonych przez aplikację usług.
 * @ORM\Entity(repositoryClass="App\Repository\BladRepository")
 * @ORM\Table(name="Bledy")
 */
class Blad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * Identyfikator typu całkowietego, po którym rozpoznajemy Błąd.
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * Ciąg znaków, który określa czego dotyczy błąd.
     */
    private $temat;

    /**
     * @ORM\Column(type="text")
     *
     * Pole tekstowe, w którym zawierać się będzie szczegółowy opis, uwagi i spostrzeżenia dot. błędu.
     */
    private $tresc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turysta")
     * @ORM\JoinColumn(nullable=false)
     *
     * Pole określające Turystę, który jest autorem zgłoszonego błędu.
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * Pole określające kategorię, w kórej zawiera się zgłaszany błąd
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
