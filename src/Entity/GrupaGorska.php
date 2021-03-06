<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa opisująca Grupę Górską - jej dane oraz powiązania z innymi Klasami w aplikacji
 * (w szczególności z Punktami i Przodownikami Turystyki Górskiej).
 * @ORM\Entity(repositoryClass="App\Repository\GrupaGorskaRepository")
 * @ORM\Table(name="Grupy_gorskie")
 */
class GrupaGorska
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * Identyfikator typu całkowietego, po którym rozpoznajemy Grupę Górską.
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * Unikalny ciąg znaków stanowiący nazwę Grupy Górskiej
     */
    private $nazwa_grupy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Punkt", mappedBy="grupa_gorska", orphanRemoval=true)
     *
     * Pole okreslajace Punkty zawierające się/wchodzące w skład Grupy Górskiej
     */
    private $punkty;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trasa", mappedBy="grupa_gorska")
     *
     * Pole określające jakie Trasy zawierają się/wchodzą w skład Grupy Górskiej
     */
    private $trasy;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PrzodownikTurystykiGorskiejPTTK", mappedBy="uprawnienia")
     *
     * Pole określające Przodowników Turystyki Górskiej, którzy mają uprawnienia
     * do zatwierdzania tras w danej Grupie Górskiej
     */
    private $przodownicy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OdcinekTrasy", mappedBy="grupa_gorska", orphanRemoval=true)
     *
     * Pole określające Odcinki Tras zawierające się w bieżącej Grupie Górskiej
     */
    private $odcinki_tras;




    public function __construct()
    {
        $this->punkty = new ArrayCollection();
        $this->trasy = new ArrayCollection();
        $this->przodownicy = new ArrayCollection();
        $this->odcinki_tras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaGrupy(): ?string
    {
        return $this->nazwa_grupy;
    }

    public function setNazwaGrupy(string $nazwa_grupy): self
    {
        $this->nazwa_grupy = $nazwa_grupy;

        return $this;
    }

    /**
     * @return Collection|Punkt[]
     *
     * Funkcja odpowiedzialna za zwrócenie Punktów należących do danej Grupy Górskiej.
     * Zwraca kolekcję Punktów należących do danej Grupy Górskiej.
     */
    public function getPunkty(): Collection
    {
        return $this->punkty;
    }

    public function addPunkty(Punkt $punkty): self
    {
        if (!$this->punkty->contains($punkty)) {
            $this->punkty[] = $punkty;
            $punkty->setGrupaGorska($this);
        }

        return $this;
    }

    public function removePunkty(Punkt $punkty): self
    {
        if ($this->punkty->contains($punkty)) {
            $this->punkty->removeElement($punkty);
            // set the owning side to null (unless already changed)
            if ($punkty->getGrupaGorska() === $this) {
                $punkty->setGrupaGorska(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trasa[]
     *
     * Funkcja odpowiedzialna za zwrócenie Tras należących do danej Grupy Górskiej.
     * Zwraca kolekcję Tras należących do danej Grupy Górskiej.
     */
    public function getTrasy(): Collection
    {
        return $this->trasy;
    }

    public function addTrasy(Trasa $trasy): self
    {
        if (!$this->trasy->contains($trasy)) {
            $this->trasy[] = $trasy;
            $trasy->setGrupaGorska($this);
        }

        return $this;
    }

    public function removeTrasy(Trasa $trasy): self
    {
        if ($this->trasy->contains($trasy)) {
            $this->trasy->removeElement($trasy);
            // set the owning side to null (unless already changed)
            if ($trasy->getGrupaGorska() === $this) {
                $trasy->setGrupaGorska(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrzodownikTurystykiGorskiejPTTK[]
     *
     * Funkcja odpowiedzialna za zwrócenie Przodowników Turystyki Górskiej
     * posiadających uprawnienia do danej Grupy Górskiej.
     * Zwraca kolekcję Przodowników Turystyki Górskiej
     * posiadających uprawnienia do danej Grupy Górskiej.
     */
    public function getPrzodownicy(): Collection
    {
        return $this->przodownicy;
    }

    public function addPrzodownicy(PrzodownikTurystykiGorskiejPTTK $przodownicy): self
    {
        if (!$this->przodownicy->contains($przodownicy)) {
            $this->przodownicy[] = $przodownicy;
            $przodownicy->addUprawnienium($this);
        }

        return $this;
    }

    public function removePrzodownicy(PrzodownikTurystykiGorskiejPTTK $przodownicy): self
    {
        if ($this->przodownicy->contains($przodownicy)) {
            $this->przodownicy->removeElement($przodownicy);
            $przodownicy->removeUprawnienium($this);
        }

        return $this;
    }

    /**
     * @return Collection|OdcinekTrasy[]
     *
     * Funkcja odpowiedzialna za zwrócenie Odcinków Tras, które zawierają się w bieżącej Grupie Górskiej.
     * Zwraca kolekcję Odcinków Tras, które zawierają się w bieżącej Grupie Górskiej.
     */
    public function getOdcinkiTras(): Collection
    {
        return $this->odcinki_tras;
    }

    public function addOdcinkiTra(OdcinekTrasy $odcinkiTra): self
    {
        if (!$this->odcinki_tras->contains($odcinkiTra)) {
            $this->odcinki_tras[] = $odcinkiTra;
            $odcinkiTra->setGrupaGorska($this);
        }

        return $this;
    }

    public function removeOdcinkiTra(OdcinekTrasy $odcinkiTra): self
    {
        if ($this->odcinki_tras->contains($odcinkiTra)) {
            $this->odcinki_tras->removeElement($odcinkiTra);
            // set the owning side to null (unless already changed)
            if ($odcinkiTra->getGrupaGorska() === $this) {
                $odcinkiTra->setGrupaGorska(null);
            }
        }

        return $this;
    }
}
