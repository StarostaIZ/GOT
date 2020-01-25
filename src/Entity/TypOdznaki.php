<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa określjaąca Typy Odznak, kóre może zobyć Turysta pokonując Trasy i Odcinki Tras.
 * @ORM\Entity(repositoryClass="App\Repository\TypOdznakiRepository")
 * @ORM\Table(name="Typy_odznak")
 */
class TypOdznaki
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * Identyfikator typu całkowietego, po którym rozpoznajemy Typ Odznaki.
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * Ciąg znaków określający nazwę Typu Odznaki.
     */
    private $nazwa_typu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaTypu(): ?string
    {
        return $this->nazwa_typu;
    }

    public function setNazwaTypu(string $nazwa_typu): self
    {
        $this->nazwa_typu = $nazwa_typu;

        return $this;
    }
}
