<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PunktRepository")
 * @ORM\Table(name="Punkty")
 */
class Punkt
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $nazwa_pkt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GrupaGorska", inversedBy="punkty")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grupa_gorska;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $szerokosc_geogr;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dlugosc_geogr;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $wysokosc;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $czy_zdef_przez_uzytk = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OdcinekTrasy", mappedBy="punkt_poczatkowy", orphanRemoval=true)
     */
    private $odcinki_tras;

    public function __construct()
    {
        $this->odcinki_tras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaPkt(): ?string
    {
        return $this->nazwa_pkt;
    }

    public function setNazwaPkt(string $nazwa_pkt): self
    {
        $this->nazwa_pkt = $nazwa_pkt;

        return $this;
    }

    public function getGrupaGorska(): ?GrupaGorska
    {
        return $this->grupa_gorska;
    }

    public function setGrupaGorska(?GrupaGorska $grupa_gorska): self
    {
        $this->grupa_gorska = $grupa_gorska;

        return $this;
    }

    public function getSzerokoscGeogr(): ?float
    {
        return $this->szerokosc_geogr;
    }

    public function setSzerokoscGeogr(float $szerokosc_geogr): self
    {
        $this->szerokosc_geogr = $szerokosc_geogr;

        return $this;
    }

    public function getDlugoscGeogr(): ?float
    {
        return $this->dlugosc_geogr;
    }

    public function setDlugoscGeogr(float $dlugosc_geogr): self
    {
        $this->dlugosc_geogr = $dlugosc_geogr;

        return $this;
    }

    public function getWysokosc(): ?float
    {
        return $this->wysokosc;
    }

    public function setWysokosc(float $wysokosc): self
    {
        $this->wysokosc = $wysokosc;

        return $this;
    }

    public function getCzyZdefPrzezUzytk(): ?bool
    {
        return $this->czy_zdef_przez_uzytk;
    }

    public function setCzyZdefPrzezUzytk(bool $czy_zdef_przez_uzytk): self
    {
        $this->czy_zdef_przez_uzytk = $czy_zdef_przez_uzytk;

        return $this;
    }

    /**
     * @return Collection|OdcinekTrasy[]
     */
    public function getOdcinkiTras(): Collection
    {
        return $this->odcinki_tras;
    }

    public function addOdcinkiTra(OdcinekTrasy $odcinkiTra): self
    {
        if (!$this->odcinki_tras->contains($odcinkiTra)) {
            $this->odcinki_tras[] = $odcinkiTra;
            $odcinkiTra->setPunktPoczatkowy($this);
        }

        return $this;
    }

    public function removeOdcinkiTra(OdcinekTrasy $odcinkiTra): self
    {
        if ($this->odcinki_tras->contains($odcinkiTra)) {
            $this->odcinki_tras->removeElement($odcinkiTra);
            // set the owning side to null (unless already changed)
            if ($odcinkiTra->getPunktPoczatkowy() === $this) {
                $odcinkiTra->setPunktPoczatkowy(null);
            }
        }

        return $this;
    }
}
