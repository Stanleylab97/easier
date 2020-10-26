<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

//normalizationContext={"groups"={"read:categorieDetails"}},

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 * @ApiResource(
 * collectionOperations={"get"},
 * itemOperations={"get"}
 * )
 * 
 */
class Categorie  //01-Particulier-02-Entreprise-03 Administration
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Abonne::class, mappedBy="categorie")
     */
    private $abonnes;

    public function __construct()
    {
        $this->abonnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    /**
     * @return Collection|Abonne[]
     */
    public function getAbonnes(): Collection
    {
        return $this->abonnes;
    }

    public function addAbonne(Abonne $abonne): self
    {
        if (!$this->abonnes->contains($abonne)) {
            $this->abonnes[] = $abonne;
            $abonne->setCategorie($this);
        }

        return $this;
    }

    public function removeAbonne(Abonne $abonne): self
    {
        if ($this->abonnes->contains($abonne)) {
            $this->abonnes->removeElement($abonne);
            // set the owning side to null (unless already changed)
            if ($abonne->getCategorie() === $this) {
                $abonne->setCategorie(null);
            }
        }

        return $this;
    }
}
