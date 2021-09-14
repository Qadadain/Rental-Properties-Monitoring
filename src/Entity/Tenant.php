<?php

namespace App\Entity;

use App\Repository\TenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TenantRepository::class)
 */
class Tenant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     */
    private $entry;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $leaveAccommodation;

    /**
     * @ORM\OneToMany(targetEntity=RentReceipt::class, mappedBy="tenant")
     */
    private $rentReceipts;

    /**
     * @ORM\ManyToOne(targetEntity=RentalProperty::class, inversedBy="tenants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rentalProperty;

    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function __construct()
    {
        $this->rentReceipts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEntry(): ?\DateTimeInterface
    {
        return $this->entry;
    }

    public function setEntry(\DateTimeInterface $entry): self
    {
        $this->entry = $entry;

        return $this;
    }

    public function getLeaveAccommodation(): ?\DateTimeInterface
    {
        return $this->leaveAccommodation;
    }

    public function setLeaveAccommodation(?\DateTimeInterface $leaveAccommodation): self
    {
        $this->leaveAccommodation = $leaveAccommodation;

        return $this;
    }

    /**
     * @return Collection|RentReceipt[]
     */
    public function getRentReceipts(): Collection
    {
        return $this->rentReceipts;
    }

    public function addRentReceipt(RentReceipt $rentReceipt): self
    {
        if (!$this->rentReceipts->contains($rentReceipt)) {
            $this->rentReceipts[] = $rentReceipt;
            $rentReceipt->setTenant($this);
        }

        return $this;
    }

    public function removeRentReceipt(RentReceipt $rentReceipt): self
    {
        if ($this->rentReceipts->removeElement($rentReceipt)) {
            // set the owning side to null (unless already changed)
            if ($rentReceipt->getTenant() === $this) {
                $rentReceipt->setTenant(null);
            }
        }

        return $this;
    }

    public function getRentalProperty(): ?RentalProperty
    {
        return $this->rentalProperty;
    }

    public function setRentalProperty(?RentalProperty $rentalProperty): self
    {
        $this->rentalProperty = $rentalProperty;

        return $this;
    }
}
