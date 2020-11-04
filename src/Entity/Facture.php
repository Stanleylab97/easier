<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureRepository;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:FactureDetails"}},
 * collectionOperations={"get"},
 * itemOperations={"get"}
 * )
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ApiProperty(identifier=false)
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(identifier=true)
     * @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $numFact;

    /**
     * @ORM\Column(type="integer",unique=true)
     * @Groups({"read:compteurDetails", "read:FactureDetails"}) 
     */    
    private $lastIndex;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $newIndex;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $nbkwh;

    /**
     * @ORM\Column(type="integer")
     *  @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $montantFact;

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $periode;

    /**
     * @ORM\ManyToOne(targetEntity=Compteur::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:FactureDetails"})
     */
    private $compteur;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $tarif;

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

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }
}
