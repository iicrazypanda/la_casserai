<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExtraRepository")
 */
class Extra
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
     * @ORM\Column(type="float")
     */
    private $meerprijs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Kamer", mappedBy="kamerId")
     */
    private $kamers;

    public function __construct()
    {
        $this->kamers = new ArrayCollection();
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

    public function getMeerprijs(): ?float
    {
        return $this->meerprijs;
    }

    public function setMeerprijs(float $meerprijs): self
    {
        $this->meerprijs = $meerprijs;

        return $this;
    }

    /**
     * @return Collection|Kamer[]
     */
    public function getKamers(): Collection
    {
        return $this->kamers;
    }

    public function addKamer(Kamer $kamer): self
    {
        if (!$this->kamers->contains($kamer)) {
            $this->kamers[] = $kamer;
            $kamer->addKamerId($this);
        }

        return $this;
    }

    public function removeKamer(Kamer $kamer): self
    {
        if ($this->kamers->contains($kamer)) {
            $this->kamers->removeElement($kamer);
            $kamer->removeKamerId($this);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->omschrijving;
    }
}
