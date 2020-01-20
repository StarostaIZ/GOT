<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypOdznakiRepository")
 * @ORM\Table(name="Typy_odznak")
 */
class TypOdznaki
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
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
