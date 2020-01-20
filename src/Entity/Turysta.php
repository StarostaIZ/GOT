<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TurystaRepository")
 * @ORM\Table(name="Turysci")
 */
class Turysta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $haslo;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $data_ur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Odznaka", mappedBy="zdobywca", orphanRemoval=true)
     */
    private $odznaki;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nazwisko;

    public function __construct()
    {
        $this->odznaki = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getHaslo(): ?string
    {
        return $this->haslo;
    }

    public function setHaslo(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDataUr(): ?\DateTimeInterface
    {
        return $this->data_ur;
    }

    public function setDataUr(\DateTimeInterface $data_ur): self
    {
        $this->data_ur = $data_ur;

        return $this;
    }

    /**
     * @return Collection|Odznaka[]
     */
    public function getOdznaki(): Collection
    {
        return $this->odznaki;
    }

    public function addOdznaka(Odznaka $odznaki): self
    {
        if (!$this->odznaki->contains($odznaki)) {
            $this->odznaki[] = $odznaki;
            $odznaki->setZdobywca($this);
        }

        return $this;
    }

    public function removeOdznaka(Odznaka $odznaki): self
    {
        if ($this->odznaki->contains($odznaki)) {
            $this->odznaki->removeElement($odznaki);
            // set the owning side to null (unless already changed)
            if ($odznaki->getZdobywca() === $this) {
                $odznaki->setZdobywca(null);
            }
        }

        return $this;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }
}
