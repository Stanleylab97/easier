<?php

namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteurRepository::class)
 */
class Compteur
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
     */
    private $carre;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $tarif;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="compteurId")
     */
    private $factures;

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

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

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
            $facture->setCompteurId($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->contains($facture)) {
            $this->factures->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getCompteurId() === $this) {
                $facture->setCompteurId(null);
            }
        }

        return $this;
    }
}
