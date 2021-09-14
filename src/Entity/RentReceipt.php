<?php

namespace App\Entity;

use App\Repository\RentReceiptRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentReceiptRepository::class)
 */
class RentReceipt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $rent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $advancesOnCharges;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startRent;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endRent;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $rentalNumber;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Tenant::class, inversedBy="rentReceipts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tenant;

    public function __toString(): string
    {
        return $this->date;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRent(): ?float
    {
        return $this->rent;
    }

    public function setRent(float $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    public function getAdvancesOnCharges(): ?float
    {
        return $this->advancesOnCharges;
    }

    public function setAdvancesOnCharges(?float $advancesOnCharges): self
    {
        $this->advancesOnCharges = $advancesOnCharges;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStartRent(): ?\DateTimeInterface
    {
        return $this->startRent;
    }

    public function setStartRent(?\DateTimeInterface $startRent): self
    {
        $this->startRent = $startRent;

        return $this;
    }

    public function getEndRent(): ?\DateTimeInterface
    {
        return $this->endRent;
    }

    public function setEndRent(?\DateTimeInterface $endRent): self
    {
        $this->endRent = $endRent;

        return $this;
    }

    public function getRentalNumber(): ?string
    {
        return $this->rentalNumber;
    }

    public function setRentalNumber(string $rentalNumber): self
    {
        $this->rentalNumber = $rentalNumber;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function setTenant(?Tenant $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }
}
