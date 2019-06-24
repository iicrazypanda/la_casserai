<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KamerRepository")
 */
class Kamer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $omschrijving;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Soort", inversedBy="kamers")
     */
    private $soort;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Extra", inversedBy="kamers")
     */
    private $kamerId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="kamerId")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservering", mappedBy="kamers")
     */
    private $reserverings;

    public function __construct()
    {
        $this->kamerId = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getSoort(): ?Soort
    {
        return $this->soort;
    }

    public function setSoort(?Soort $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * @return Collection|Extra[]
     */
    public function getKamerId(): Collection
    {
        return $this->kamerId;
    }

    public function addKamerId(Extra $kamerId): self
    {
        if (!$this->kamerId->contains($kamerId)) {
            $this->kamerId[] = $kamerId;
        }

        return $this;
    }

    public function removeKamerId(Extra $kamerId): self
    {
        if ($this->kamerId->contains($kamerId)) {
            $this->kamerId->removeElement($kamerId);
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setKamerId($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getKamerId() === $this) {
                $image->setKamerId(null);
            }
        }

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
            $reservering->setKamers($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->contains($reservering)) {
            $this->reserverings->removeElement($reservering);
            // set the owning side to null (unless already changed)
            if ($reservering->getKamers() === $this) {
                $reservering->setKamers(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->omschrijving;
    }
}
