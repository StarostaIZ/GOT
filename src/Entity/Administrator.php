<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdministratorRepository")
 * @ORM\Table(name="Administratorzy")
 */
class Administrator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $haslo;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $data_ur;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     */
    private $pesel;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     */
    private $nr_tel;

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

    public function getPesel(): ?string
    {
        return $this->pesel;
    }

    public function setPesel(string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    public function getNrTel(): ?string
    {
        return $this->nr_tel;
    }

    public function setNrTel(string $nr_tel): self
    {
        $this->nr_tel = $nr_tel;

        return $this;
    }
}
