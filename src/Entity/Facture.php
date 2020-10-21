<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 * @ApiResource()
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numFact;

    /**
     * @ORM\Column(type="integer")
     */
    private $lastIndex;

    /**
     * @ORM\Column(type="integer")
     */
    private $newIndex;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbkwh;

    /**
     * @ORM\Column(type="bigint")
     */
    private $montantFact;

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $periode;

    /**
     * @ORM\ManyToOne(targetEntity=Compteur::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumFact(): ?string
    {
        return $this->numFact;
    }

    public function setNumFact(string $numFact): self
    {
        $this->numFact = $numFact;

        return $this;
    }

    public function getLastIndex(): ?int
    {
        return $this->lastIndex;
    }

    public function setLastIndex(int $lastIndex): self
    {
        $this->lastIndex = $lastIndex;

        return $this;
    }

    public function getNewIndex(): ?int
    {
        return $this->newIndex;
    }

    public function setNewIndex(int $newIndex): self
    {
        $this->newIndex = $newIndex;

        return $this;
    }

    public function getNbkwh(): ?int
    {
        return $this->nbkwh;
    }

    public function setNbkwh(int $nbkwh): self
    {
        $this->nbkwh = $nbkwh;

        return $this;
    }

    public function getMontantFact(): ?string
    {
        return $this->montantFact;
    }

    public function setMontantFact(string $montantFact): self
    {
        $this->montantFact = $montantFact;

        return $this;
    }

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getCompteur(): ?Compteur
    {
        return $this->compteur;
    }

    public function setCompteur(?Compteur $compteur): self
    {
        $this->compteur = $compteur;

        return $this;
    }
}
