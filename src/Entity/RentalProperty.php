<?php

namespace App\Entity;

use App\Repository\RentalPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalPropertyRepository::class)
 */
class RentalProperty
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=RentalPropertyType::class, inversedBy="rentalProperty")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rentalPropertyType;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="rentalProperty")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    /**
     * @ORM\OneToMany(targetEntity=RentalPropertyAccounting::class, mappedBy="rentalProperty")
     */
    private $rentalPropertyAccounting;

    /**
     * @ORM\OneToMany(targetEntity=Tenant::class, mappedBy="rentalProperty")
     */
    private $tenants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->rentalPropertyAccounting = new ArrayCollection();
        $this->tenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRentalPropertyType(): ?RentalPropertyType
    {
        return $this->rentalPropertyType;
    }

    public function setRentalPropertyType(?RentalPropertyType $rentalPropertyType): self
    {
        $this->rentalPropertyType = $rentalPropertyType;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return Collection|RentalPropertyAccounting[]
     */
    public function getRentalPropertyAccounting(): Collection
    {
        return $this->rentalPropertyAccounting;
    }

    public function addRentalPropertyAccounting(RentalPropertyAccounting $rentalPropertyAccounting): self
    {
        if (!$this->rentalPropertyAccounting->contains($rentalPropertyAccounting)) {
            $this->rentalPropertyAccounting[] = $rentalPropertyAccounting;
            $rentalPropertyAccounting->setRentalProperty($this);
        }

        return $this;
    }

    public function removeRentalPropertyAccounting(RentalPropertyAccounting $rentalPropertyAccounting): self
    {
        if ($this->rentalPropertyAccounting->removeElement($rentalPropertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($rentalPropertyAccounting->getRentalProperty() === $this) {
                $rentalPropertyAccounting->setRentalProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tenant[]
     */
    public function getTenants(): Collection
    {
        return $this->tenants;
    }

    public function addTenant(Tenant $tenant): self
    {
        if (!$this->tenants->contains($tenant)) {
            $this->tenants[] = $tenant;
            $tenant->setRentalProperty($this);
        }

        return $this;
    }

    public function removeTenant(Tenant $tenant): self
    {
        if ($this->tenants->removeElement($tenant)) {
            // set the owning side to null (unless already changed)
            if ($tenant->getRentalProperty() === $this) {
                $tenant->setRentalProperty(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
