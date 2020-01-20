<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OdznakaRepository")
 * @ORM\Table(name="Odznaki")
 */
class Odznaka
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turysta", inversedBy="odznaki")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zdobywca;

    /**
     * @ORM\Column(type="integer")
     */
    private $potrzebna_ilosc_pkt;

    /**
     * @ORM\Column(type="integer")
     */
    private $aktualna_ilosc_pkt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $czy_zdobyto;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $kiedy_zdobyto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypOdznaki")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typ_odznaki;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trasa", mappedBy="odznaka", orphanRemoval=true)
     */
    private $trasy;


    public function __construct()
    {
        $this->trasy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZdobywca(): ?Turysta
    {
        return $this->zdobywca;
    }

    public function setZdobywca(?Turysta $zdobywca): self
    {
        $this->zdobywca = $zdobywca;

        return $this;
    }

    public function getPotrzebnaIloscPkt(): ?int
    {
        return $this->potrzebna_ilosc_pkt;
    }

    public function setPotrzebnaIloscPkt(int $potrzebna_ilosc_pkt): self
    {
        $this->potrzebna_ilosc_pkt = $potrzebna_ilosc_pkt;

        return $this;
    }

    public function getAktualnaIloscPkt(): ?int
    {
        return $this->aktualna_ilosc_pkt;
    }

    public function setAktualnaIloscPkt(int $aktualna_ilosc_pkt): self
    {
        $this->aktualna_ilosc_pkt = $aktualna_ilosc_pkt;

        return $this;
    }

    public function getCzyZdobyto(): ?bool
    {
        return $this->czy_zdobyto;
    }

    public function setCzyZdobyto(bool $czy_zdobyto): self
    {
        $this->czy_zdobyto = $czy_zdobyto;

        return $this;
    }

    public function getKiedyZdobyto(): ?\DateTimeInterface
    {
        return $this->kiedy_zdobyto;
    }

    public function setKiedyZdobyto(?\DateTimeInterface $kiedy_zdobyto): self
    {
        $this->kiedy_zdobyto = $kiedy_zdobyto;

        return $this;
    }

    public function getTypOdznaki(): ?TypOdznaki
    {
        return $this->typ_odznaki;
    }

    public function setTypOdznaki(?TypOdznaki $typ_odznaki): self
    {
        $this->typ_odznaki = $typ_odznaki;

        return $this;
    }

    /**
     * @return Collection|Trasa[]
     */
    public function getTrasy(): Collection
    {
        return $this->trasy;
    }

    public function addTrasy(Trasa $trasy): self
    {
        if (!$this->trasy->contains($trasy)) {
            $this->trasy[] = $trasy;
            $trasy->setOdznaka($this);
        }

        return $this;
    }

    public function removeTrasy(Trasa $trasy): self
    {
        if ($this->trasy->contains($trasy)) {
            $this->trasy->removeElement($trasy);
            // set the owning side to null (unless already changed)
            if ($trasy->getOdznaka() === $this) {
                $trasy->setOdznaka(null);
            }
        }

        return $this;
    }
}
