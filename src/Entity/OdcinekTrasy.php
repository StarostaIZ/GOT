<?php

namespace App\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Klasa opisująca Odcinek Trasy oraz zależności między nim i innymi komponentami aplikacji     
 * @ORM\Entity(repositoryClass="App\Repository\OdcinekTrasyRepository")
 * @ORM\Table(name="Odcinki_tras", uniqueConstraints={@ORM\UniqueConstraint(columns={"punkt_poczatkowy_id", "punkt_koncowy_id"})})
 */
class OdcinekTrasy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * Identyfikator typu całkowietego, po którym rozpoznajemy Odcinek Trasy.
     */
    private $id;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="float", nullable=true)
     *
     * Wartość typu zmiennoprzecinkowego, określająca całkowitą długość Odcinka Trasy.
     */
    private $dlugosc;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="integer")
     *
     * Wartość typu całkowitego określająca liczbę punktów przyznawaną
     * Turyście za przebycie danego Odcinka Trasy.
     */
    private $pkt_za_przejsce;

    /**
     * @Assert\PositiveOrZero()
     * @ORM\Column(type="integer")
     *
     * Wartość typu całkowitego określająca liczbę punktów przyznawaną
     * Turyście za powrtót do punktu początkowego na tym samym Odcinku Trasy.
     */
    private $pkt_za_powrot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Punkt", inversedBy="odcinki_tras")
     * @ORM\JoinColumn(nullable=false)
     *
     * Pole określające Punkt początkowy Odcinka Trasy
     */
    private $punkt_poczatkowy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Punkt")
     * @ORM\JoinColumn(nullable=false)
     *
     * Pole określające Punkt końcowy Odcinka Trasy
     */
    private $punkt_koncowy;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * Zmienna typu boolowskiego określająca, czy odcinek został zatwierdzony
     * w systemie przez uprawnionego Przodownika Turystyki Górskiej.
     */
    private $czy_zatwierdzone_przez_przodownika;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PrzodownikTurystykiGorskiejPTTK", inversedBy="zatwierdzone_odcinki_tras")
     * @ORM\JoinColumn(nullable=true)
     *
     * Pole określające konkretnego Przodownika Turystyki Górskiej,
     * który odpowiedzialny był za zatwierdzenie danego Odcinka Trasy,
     * w przypadku, gdy Odcinek Trasy został zatwierdzony.
     */
    private $przowodnik_zatwierdzajacy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * Wartość typu całkowitego określająca sumę wszysktich przewyższeń na danym Odcinku Trasy.
     */
    private $suma_przewyzszen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * Wartość typu całkowitego określająca sumę wszysktich spadków na  danym Odcinku Trasy.
     */
    private $suma_spadkow;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GrupaGorska", inversedBy="odcinki_tras")
     * @ORM\JoinColumn(nullable=true)
     *
     * Pole określające w jakiej Grupie Górskiej zawiera się bieżący Odcinek Trasy
     */
    private $grupa_gorska;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPktZaPrzejsce(): ?int
    {
        return $this->pkt_za_przejsce;
    }

    public function setPktZaPrzejsce(int $pkt_za_przejsce): self
    {
        $this->pkt_za_przejsce = $pkt_za_przejsce;

        return $this;
    }

    public function getPktZaPowrot(): ?int
    {
        return $this->pkt_za_powrot;
    }

    public function setPktZaPowrot(int $pkt_za_powrot): self
    {
        $this->pkt_za_powrot = $pkt_za_powrot;

        return $this;
    }

    public function getPunktPoczatkowy(): ?Punkt
    {
        return $this->punkt_poczatkowy;
    }

    public function setPunktPoczatkowy(?Punkt $punkt_poczatkowy): self
    {
        $this->punkt_poczatkowy = $punkt_poczatkowy;

        return $this;
    }

    public function getPunktKoncowy(): ?Punkt
    {
        return $this->punkt_koncowy;
    }

    public function setPunktKoncowy(?Punkt $punkt_koncowy): self
    {
        $this->punkt_koncowy = $punkt_koncowy;

        return $this;
    }

    public function getCzyZatwierdzonePrzezPrzodownika(): ?bool
    {
        return $this->czy_zatwierdzone_przez_przodownika;
    }

    public function setCzyZatwierdzonePrzezPrzodownika(bool $czy_zatwierdzone_przez_przodownika): self
    {
        $this->czy_zatwierdzone_przez_przodownika = $czy_zatwierdzone_przez_przodownika;

        return $this;
    }

    public function getPrzowodnikZatwierdzajacy(): ?PrzodownikTurystykiGorskiejPTTK
    {
        return $this->przowodnik_zatwierdzajacy;
    }

    public function setPrzowodnikZatwierdzajacy(?PrzodownikTurystykiGorskiejPTTK $przowodnik_zatwierdzajacy): self
    {
        $this->przowodnik_zatwierdzajacy = $przowodnik_zatwierdzajacy;

        return $this;
    }

    public function getSumaprzewyzszen(): ?int
    {
        return $this->suma_przewyzszen;
    }

    public function setSumaprzewyzszen(?int $suma_przewyzszen): self
    {
        $this->suma_przewyzszen = $suma_przewyzszen;

        return $this;
    }

    public function getSumaspadkow(): ?int
    {
        return $this->suma_spadkow;
    }

    public function setSumaspadkow(?int $suma_spadkow): self
    {
        $this->suma_spadkow = $suma_spadkow;

        return $this;
    }

    /**
     * @Assert\Callback()
     * @param ExecutionContextInterface $context
     * @param $payload
     *
     * Funkcja odpowiedzialna za zabezpieczenie przed wprowadzeniem
     * tego samego Punktu jako punktu początkowego i punktu końcowego.
     * Zwraca komunikat o identyczności wprowadzonych Punktów  w przypadku, gdy są takie same.
     * Przyjmuje parametr 'payload', który osobiście nie wiem co robi, ale przyjmuje.
     */
    public function validate(ExecutionContextInterface $context,$payload)
    {
        if($this->getPunktKoncowy()->getId() == $this->getPunktPoczatkowy()->getId()){
            $context->buildViolation('Punkt początkowy musi różnić się od końcowego')
                ->atPath('punkt_poczatkowy')
                ->addViolation();
        }
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
}
