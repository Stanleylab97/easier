<?php

namespace App\Entity;

use App\Repository\BordereauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BordereauRepository::class)
 */
class Bordereau
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
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quartier;

    /**
     * @ORM\OneToMany(targetEntity=Compteur::class, mappedBy="bordereau")
     */
    private $compteurs;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="bordereaux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenceId;

    public function __construct()
    {
        $this->compteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * @return Collection|Compteur[]
     */
    public function getCompteurs(): Collection
    {
        return $this->compteurs;
    }

    public function addCompteur(Compteur $compteur): self
    {
        if (!$this->compteurs->contains($compteur)) {
            $this->compteurs[] = $compteur;
            $compteur->setBordereau($this);
        }

        return $this;
    }

    public function removeCompteur(Compteur $compteur): self
    {
        if ($this->compteurs->contains($compteur)) {
            $this->compteurs->removeElement($compteur);
            // set the owning side to null (unless already changed)
            if ($compteur->getBordereau() === $this) {
                $compteur->setBordereau(null);
            }
        }

        return $this;
    }

    public function getAgenceId(): ?Agence
    {
        return $this->agenceId;
    }

    public function setAgenceId(?Agence $agenceId): self
    {
        $this->agenceId = $agenceId;

        return $this;
    }
}
