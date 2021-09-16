<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
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
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=RentalProperty::class, mappedBy="property")
     */
    private $rentalProperty;

    /**
     * @ORM\OneToMany(targetEntity=PropertyAccounting::class, mappedBy="property")
     */
    private $propertyAccounting;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->rentalProperty = new ArrayCollection();
        $this->propertyAccounting = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|RentalProperty[]
     */
    public function getRentalProperty(): Collection
    {
        return $this->rentalProperty;
    }

    public function addRentalProperty(RentalProperty $rentalProperty): self
    {
        if (!$this->rentalProperty->contains($rentalProperty)) {
            $this->rentalProperty[] = $rentalProperty;
            $rentalProperty->setProperty($this);
        }

        return $this;
    }

    public function removeRentalProperty(RentalProperty $rentalProperty): self
    {
        if ($this->rentalProperty->removeElement($rentalProperty)) {
            // set the owning side to null (unless already changed)
            if ($rentalProperty->getProperty() === $this) {
                $rentalProperty->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PropertyAccounting[]
     */
    public function getPropertyAccounting(): Collection
    {
        return $this->propertyAccounting;
    }

    public function addPropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if (!$this->propertyAccounting->contains($propertyAccounting)) {
            $this->propertyAccounting[] = $propertyAccounting;
            $propertyAccounting->setProperty($this);
        }

        return $this;
    }

    public function removePropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if ($this->propertyAccounting->removeElement($propertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($propertyAccounting->getProperty() === $this) {
                $propertyAccounting->setProperty(null);
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
