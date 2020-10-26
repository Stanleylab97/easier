<?php

namespace App\Entity;

use App\Repository\QuittanceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=QuittanceRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"quittance"}},
 * collectionOperations={"post","get"},
 * itemOperations={"get"}
 *)
 */
class Quittance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * Groups({"quittance"})
     */
    private $dateReglement;

    /**
     * @ORM\Column(type="string", length=255)
     * Groups({"quittance"})
     */
    private $moyen;

    /**
     * @ORM\Column(type="bigint")
     * Groups({"quittance"})
     */
    private $transactionId;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $facture;

    /**
     * @ORM\Column(type="string", length=255)
     * Groups({"quittance"})
     */
    private $numQuittance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReglement(): ?\DateTimeInterface
    {
        return $this->dateReglement;
    }

    public function setDateReglement(\DateTimeInterface $dateReglement): self
    {
        $this->dateReglement = $dateReglement;

        return $this;
    }

    public function getMoyen(): ?string
    {
        return $this->moyen;
    }

    public function setMoyen(string $moyen): self
    {
        $this->moyen = $moyen;

        return $this;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): self
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFactureId(Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getNumQuittance(): ?string
    {
        return $this->numQuittance;
    }

    public function setNumQuittance(string $numQuittance): self
    {
        $this->numQuittance = $numQuittance;

        return $this;
    }
}
