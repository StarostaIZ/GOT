<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrasaRepository")
 * @ORM\Table(name="Trasy")
 */
class Trasa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $data_utworzenia;

    /**
     * @ORM\Column(type="integer")
     */
    private $suma_pkt;

    /**
     * @ORM\Column(type="float")
     */
    private $dlugosc;

    /**
     * @ORM\Column(type="float")
     */
    private $roznica_wysokosci;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GrupaGorska", inversedBy="trasy")
     */
    private $grupa_gorska;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $data_pokonania;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Odznaka", inversedBy="trasy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $odznaka;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\OdcinekTrasy")
     */
    private $odcinki_tworzace_trase;




    public function __construct()
    {
        $this->odcinki_tworzace_trase = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataUtworzenia(): ?\DateTimeInterface
    {
        return $this->data_utworzenia;
    }

    public function setDataUtworzenia(\DateTimeInterface $data_utworzenia): self
    {
        $this->data_utworzenia = $data_utworzenia;

        return $this;
    }

    public function getSumaPkt(): ?int
    {
        return $this->suma_pkt;
    }

    public function setSumaPkt(int $suma_pkt): self
    {
        $this->suma_pkt = $suma_pkt;

        return $this;
    }

    public function getDlugosc(): ?float
    {
        return $this->dlugosc;
    }

    public function setDlugosc(float $dlugosc): self
    {
        $this->dlugosc = $dlugosc;

        return $this;
    }

    public function getRoznicaWysokosci(): ?float
    {
        return $this->roznica_wysokosci;
    }

    public function setRoznicaWysokosci(float $roznica_wysokosci): self
    {
        $this->roznica_wysokosci = $roznica_wysokosci;

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

    public function getDataPokonania(): ?\DateTimeInterface
    {
        return $this->data_pokonania;
    }

    public function setDataPokonania(?\DateTimeInterface $data_pokonania): self
    {
        $this->data_pokonania = $data_pokonania;

        return $this;
    }

    public function getOdznaka(): ?Odznaka
    {
        return $this->odznaka;
    }

    public function setOdznaka(?Odznaka $odznaka): self
    {
        $this->odznaka = $odznaka;

        return $this;
    }

    /**
     * @return Collection|OdcinekTrasy[]
     */
    public function getOdcinkiTworzaceTrase(): Collection
    {
        return $this->odcinki_tworzace_trase;
    }

    public function addOdcinkiTworzaceTrase(OdcinekTrasy $odcinkiTworzaceTrase): self
    {
        if (!$this->odcinki_tworzace_trase->contains($odcinkiTworzaceTrase)) {
            $this->odcinki_tworzace_trase[] = $odcinkiTworzaceTrase;
        }

        return $this;
    }

    public function removeOdcinkiTworzaceTrase(OdcinekTrasy $odcinkiTworzaceTrase): self
    {
        if ($this->odcinki_tworzace_trase->contains($odcinkiTworzaceTrase)) {
            $this->odcinki_tworzace_trase->removeElement($odcinkiTworzaceTrase);
        }

        return $this;
    }




}
