<?php

namespace App\Entity;

use App\Repository\AbonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonneRepository::class)
 */
class Abonne
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
    private $numAbonne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="abonnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Compteur::class, mappedBy="abonne")
     */
    private $compteurs;

    public function __construct()
    {
        $this->compteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAbonne(): ?string
    {
        return $this->numAbonne;
    }

    public function setNumAbonne(string $numAbonne): self
    {
        $this->numAbonne = $numAbonne;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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
            $compteur->setAbonne($this);
        }

        return $this;
    }

    public function removeCompteur(Compteur $compteur): self
    {
        if ($this->compteurs->contains($compteur)) {
            $this->compteurs->removeElement($compteur);
            // set the owning side to null (unless already changed)
            if ($compteur->getAbonne() === $this) {
                $compteur->setAbonne(null);
            }
        }

        return $this;
    }
}
