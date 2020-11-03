<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompteurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=CompteurRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:compteurDetails"},
 * "enable_max_depth"=true},
 * collectionOperations={"get"},
 * itemOperations={"get"},
 * )
 */
class Compteur
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
     * @Groups({"read:compteurDetails", "read:FactureDetails"})
     * @ApiProperty(identifier=true)
     */
    private $numPolice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $puissance;

    /**
     * @ORM\ManyToOne(targetEntity=Bordereau::class, inversedBy="compteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bordereau;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $carre;

   

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="compteurId")
     */
    private $factures;

    /**
     * @ORM\ManyToOne(targetEntity=Abonne::class, inversedBy="compteurs")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups({"read:compteurDetails", "read:FactureDetails"})
     */
    private $abonne;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumPolice(): ?string
    {
        return $this->numPolice;
    }

    public function setNumPolice(string $numPolice): self
    {
        $this->numPolice = $numPolice;

        return $this;
    }

    public function getPuissance(): ?string
    {
        return $this->puissance;
    }

    public function setPuissance(string $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getBordereau(): ?Bordereau
    {
        return $this->bordereau;
    }

    public function setBordereau(?Bordereau $bordereau): self
    {
        $this->bordereau = $bordereau;

        return $this;
    }

    public function getCarre(): ?string
    {
        return $this->carre;
    }

    public function setCarre(string $carre): self
    {
        $this->carre = $carre;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setCompteur($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->contains($facture)) {
            $this->factures->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getCompteur() === $this) {
                $facture->setCompteur(null);
            }
        }

        return $this;
    }

    public function getAbonne(): ?Abonne
    {
        return $this->abonne;
    }

    public function setAbonne(?Abonne $abonne): self
    {
        $this->abonne = $abonne;

        return $this;
    }
}
