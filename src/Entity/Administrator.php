<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa opisująca Administratora, osobę z dostępęm do gamy zaawansowanych funkcjonalności.
 * @ORM\Entity(repositoryClass="App\Repository\AdministratorRepository")
 * @ORM\Table(name="Administratorzy")
 */
class Administrator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * Identyfikator typu całkowietego, po którym rozpoznajemy Administratora.
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     *
     * Unikalny ciąg znaków o długości 20 stanowiący Login Administratora.
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * Hasło logowania dla bieżącego Administratora.
     */
    private $haslo;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     *
     * Uniklany adres mailowy Administratora o maksymalnej długości 25 znaków.
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     *
     * Data urodzenia Administratora.
     */
    private $data_ur;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     *
     * Unikalny ciąg znaków o dlugości 11 stanowiący Numer PESEL Administratora
     */
    private $pesel;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     *
     * Unikalny telefon kontaktowy do Administratora
     */
    private $nr_tel;

    /**
     * @return int|null
     *
     * Funkcja zwracająca Identyfikator Administratora
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     *
     * Funkcja zwracająca Login Administratora
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return $this
     *
     * Funkcja ustawiająąca Login Administratora na konkretną wartość będącą ciągiem znaków.
     * Przyjmuje parametr 'login' będący nową wartością Loginu dla Administratora
     * Zwraca obiekt ze zaktualizowaną wartością atrybut Login Administratora.
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string|null
     *
     * Funkcja zwracająca Hasło Administratora
     */
    public function getHaslo(): ?string
    {
        return $this->haslo;
    }

    /**
     * @param string $haslo
     * @return $this
     *
     * Funkcja ustawiająąca Hasło Administratora na konkretną wartość będącą ciągiem znaków.
     * Przyjmuje parametr 'haslo' będący nową wartością Hasła dla Administratora
     * Zwraca obiekt ze zaktualizowaną wartością atrybutu Hasło Administratora.
     */
    public function setHaslo(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    /**
     * @return string|null
     *
     * Funkcja zwracająca Adres Mailowy Administratora.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     *
     * Funkcja ustawiająąca Adres Mailowy Administratora na konkretną wartość będącą ciągiem znaków.
     * Przyjmuje parametr '$email' będący nową wartością Adresu Mailowego dla Administratora
     * Zwraca obiekt ze zaktualizowaną wartością atrybutu Adres Mailowy Administratora.
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     *
     * Funkjca zwracająca Datę Urodzenia Administratora
     */
    public function getDataUr(): ?\DateTimeInterface
    {
        return $this->data_ur;
    }

    /**
     * @param \DateTimeInterface $data_ur
     * @return $this
     *
     * Funkcja ustawiająąca Datę Urodzenia Administratora na konkretną wartość będącą obiektem typu DateTimeInterface.
     * Przyjmuje parametr 'data_ur' będący nową wartością Daty Urodzenia dla Administratora
     * Zwraca obiekt ze zaktualizowaną wartością atrybutu Data Urodzenia Administratora.
     */
    public function setDataUr(\DateTimeInterface $data_ur): self
    {
        $this->data_ur = $data_ur;

        return $this;
    }

    /**
     * @return string|null
     *
     * Funkcja zwracająca PESEL Administratora
     */
    public function getPesel(): ?string
    {
        return $this->pesel;
    }

    /**
     * @param string $pesel
     * @return $this
     *
     * Funkcja ustawiająąca PESEL Administratora na konkretną wartość będącą ciągiem znaków.
     * Przyjmuje parametr 'pesel' będący nową wartością numeru PESEL dla Administratora
     * Zwraca obiekt ze zaktualizowaną wartością atrybutu PESEL Administratora.
     */
    public function setPesel(string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * @return string|null
     *
     * Funkjca zwracająca Telefon Kontaktowy Administratora.
     */
    public function getNrTel(): ?string
    {
        return $this->nr_tel;
    }

    /**
     * @param string $nr_tel
     * @return $this
     *
     * Funkcja ustawiająąca Telefon Kontaktowy Administratora na konkretną wartość będącą ciągiem znaków.
     * Przyjmuje parametr 'nr_tel' będący nową wartością Telefonu Kontaktowy dla Administratora
     * Zwraca obiekt ze zaktualizowaną wartością atrybutu Telefon Kontaktowy Administratora.
     */
    public function setNrTel(string $nr_tel): self
    {
        $this->nr_tel = $nr_tel;

        return $this;
    }
}
