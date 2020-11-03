<?php

namespace App\Entity;

use App\Repository\GuichetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuichetRepository::class)
 */
class Guichet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="guichets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    /**
     * @ORM\OneToMany(targetEntity=Quittance::class, mappedBy="guichet")
     */
    private $quittances;

    public function __construct()
    {
        $this->quittances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * @return Collection|Quittance[]
     */
    public function getQuittances(): Collection
    {
        return $this->quittances;
    }

    public function addQuittance(Quittance $quittance): self
    {
        if (!$this->quittances->contains($quittance)) {
            $this->quittances[] = $quittance;
            $quittance->setGuichet($this);
        }

        return $this;
    }

    public function removeQuittance(Quittance $quittance): self
    {
        if ($this->quittances->contains($quittance)) {
            $this->quittances->removeElement($quittance);
            // set the owning side to null (unless already changed)
            if ($quittance->getGuichet() === $this) {
                $quittance->setGuichet(null);
            }
        }

        return $this;
    }
}
