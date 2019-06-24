<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_activity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel_nr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mobile_nr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $insertion_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organisatie", inversedBy="users")
     */
    private $organisaties;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Functie", inversedBy="users")
     */
    private $functions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservering", mappedBy="users", orphanRemoval=true)
     */
    private $reserverings;

    public function __construct()
    {
        parent::__construct();
        $this->reserverings = new ArrayCollection();
        // your own logic
    }

    public function getLastActivity(): ?string
    {
        return $this->last_activity;
    }

    public function setLastActivity(string $last_activity): self
    {
        $this->last_activity = $last_activity;

        return $this;
    }

    public function getTelNr(): ?string
    {
        return $this->tel_nr;
    }

    public function setTelNr(string $tel_nr): self
    {
        $this->tel_nr = $tel_nr;

        return $this;
    }

    public function getMobileNr(): ?string
    {
        return $this->mobile_nr;
    }

    public function setMobileNr(string $mobile_nr): self
    {
        $this->mobile_nr = $mobile_nr;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getInsertionName(): ?string
    {
        return $this->insertion_name;
    }

    public function setInsertionName(string $insertion_name): self
    {
        $this->insertion_name = $insertion_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getOrganisaties(): ?Organisatie
    {
        return $this->organisaties;
    }

    public function setOrganisaties(?Organisatie $organisaties): self
    {
        $this->organisaties = $organisaties;

        return $this;
    }

    public function getFunctions(): ?Functie
    {
        return $this->functions;
    }

    public function setFunctions(?Functie $functions): self
    {
        $this->functions = $functions;

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setUsers($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->contains($reservering)) {
            $this->reserverings->removeElement($reservering);
            // set the owning side to null (unless already changed)
            if ($reservering->getUsers() === $this) {
                $reservering->setUsers(null);
            }
        }

        return $this;
    }
}