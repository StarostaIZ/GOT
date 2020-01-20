<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrzodownikTurystykiGorskiejPTTKRepository")
 * @ORM\Table(name="Przodownicy_turystyki_gorskiej_PTTK")
 */
class PrzodownikTurystykiGorskiejPTTK
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OdcinekTrasy", mappedBy="przowodnik_zatwierdzajacy", orphanRemoval=true)
     */
    private $zatwierdzone_odcinki_tras;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\GrupaGorska", inversedBy="przodownicy")
     */
    private $uprawnienia;

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
        $this->zatwierdzone_odcinki_tras = new ArrayCollection();
        $this->uprawnienia = new ArrayCollection();
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

    /**
     * @return Collection|OdcinekTrasy[]
     */
    public function getZatwierdzoneOdcinkiTras(): Collection
    {
        return $this->zatwierdzone_odcinki_tras;
    }

    public function addZatwierdzoneOdcinkiTra(OdcinekTrasy $zatwierdzoneOdcinkiTra): self
    {
        if (!$this->zatwierdzone_odcinki_tras->contains($zatwierdzoneOdcinkiTra)) {
            $this->zatwierdzone_odcinki_tras[] = $zatwierdzoneOdcinkiTra;
            $zatwierdzoneOdcinkiTra->setPrzowodnikZatwierdzajacy($this);
        }

        return $this;
    }

    public function removeZatwierdzoneOdcinkiTra(OdcinekTrasy $zatwierdzoneOdcinkiTra): self
    {
        if ($this->zatwierdzone_odcinki_tras->contains($zatwierdzoneOdcinkiTra)) {
            $this->zatwierdzone_odcinki_tras->removeElement($zatwierdzoneOdcinkiTra);
            // set the owning side to null (unless already changed)
            if ($zatwierdzoneOdcinkiTra->getPrzowodnikZatwierdzajacy() === $this) {
                $zatwierdzoneOdcinkiTra->setPrzowodnikZatwierdzajacy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GrupaGorska[]
     */
    public function getUprawnienia(): Collection
    {
        return $this->uprawnienia;
    }

    public function addUprawnienium(GrupaGorska $uprawnienium): self
    {
        if (!$this->uprawnienia->contains($uprawnienium)) {
            $this->uprawnienia[] = $uprawnienium;
        }

        return $this;
    }

    public function removeUprawnienium(GrupaGorska $uprawnienium): self
    {
        if ($this->uprawnienia->contains($uprawnienium)) {
            $this->uprawnienia->removeElement($uprawnienium);
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
