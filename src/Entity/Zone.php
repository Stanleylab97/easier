<?php

namespace App\Entity;

use App\Repository\ZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZoneRepository::class)
 */
class Zone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $sigle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Direction::class, inversedBy="zones")
     * @ORM\JoinColumn(nullable=false)
     */
    

    /**
     * @ORM\OneToMany(targetEntity=Bordereau::class, mappedBy="zone")
     */
    private $bordereaux;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="zones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    public function __construct()
    {
        $this->bordereaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): self
    {
        $this->sigle = $sigle;

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
     * @return Collection|Bordereau[]
     */
    public function getBordereaux(): Collection
    {
        return $this->bordereaux;
    }

    public function addBordereaux(Bordereau $bordereaux): self
    {
        if (!$this->bordereaux->contains($bordereaux)) {
            $this->bordereaux[] = $bordereaux;
            $bordereaux->setZone($this);
        }

        return $this;
    }

    public function removeBordereaux(Bordereau $bordereaux): self
    {
        if ($this->bordereaux->contains($bordereaux)) {
            $this->bordereaux->removeElement($bordereaux);
            // set the owning side to null (unless already changed)
            if ($bordereaux->getZone() === $this) {
                $bordereaux->setZone(null);
            }
        }

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
}
