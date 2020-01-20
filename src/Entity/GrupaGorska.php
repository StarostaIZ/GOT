<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrupaGorskaRepository")
 * @ORM\Table(name="Grupy_gorskie")
 */
class GrupaGorska
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
    private $nazwa_grupy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Punkt", mappedBy="grupa_gorska", orphanRemoval=true)
     */
    private $punkty;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trasa", mappedBy="grupa_gorska")
     */
    private $trasy;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PrzodownikTurystykiGorskiejPTTK", mappedBy="uprawnienia")
     */
    private $przodownicy;




    public function __construct()
    {
        $this->punkty = new ArrayCollection();
        $this->trasy = new ArrayCollection();
        $this->przodownicy = new ArrayCollection();
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
}
