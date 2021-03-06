<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
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
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     */
    private $lon;

    /**
     * @ORM\OneToMany(targetEntity=Bordereau::class, mappedBy="agenceId")
     */
    private $bordereaux;

    /**
     * @ORM\ManyToOne(targetEntity=Direction::class, inversedBy="agences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $direction;

    /**
     * @ORM\OneToMany(targetEntity=Zone::class, mappedBy="agence", orphanRemoval=true)
     */
    private $zones;

    /**
     * @ORM\OneToMany(targetEntity=Guichet::class, mappedBy="agence")
     */
    private $guichets;

    public function __construct()
    {
        $this->bordereaux = new ArrayCollection();
        $this->zones = new ArrayCollection();
        $this->guichets = new ArrayCollection();
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

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

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
            $bordereaux->setAgence($this);
        }

        return $this;
    }

    public function removeBordereaux(Bordereau $bordereaux): self
    {
        if ($this->bordereaux->contains($bordereaux)) {
            $this->bordereaux->removeElement($bordereaux);
            // set the owning side to null (unless already changed)
            if ($bordereaux->getAgence() === $this) {
                $bordereaux->setAgence(null);
            }
        }

        return $this;
    }

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(?Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return Collection|Zone[]
     */
    public function getZones(): Collection
    {
        return $this->zones;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
            $zone->setAgence($this);
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        if ($this->zones->contains($zone)) {
            $this->zones->removeElement($zone);
            // set the owning side to null (unless already changed)
            if ($zone->getAgence() === $this) {
                $zone->setAgence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Guichet[]
     */
    public function getGuichets(): Collection
    {
        return $this->guichets;
    }

    public function addGuichet(Guichet $guichet): self
    {
        if (!$this->guichets->contains($guichet)) {
            $this->guichets[] = $guichet;
            $guichet->setAgence($this);
        }

        return $this;
    }

    public function removeGuichet(Guichet $guichet): self
    {
        if ($this->guichets->contains($guichet)) {
            $this->guichets->removeElement($guichet);
            // set the owning side to null (unless already changed)
            if ($guichet->getAgence() === $this) {
                $guichet->setAgence(null);
            }
        }

        return $this;
    }
}
