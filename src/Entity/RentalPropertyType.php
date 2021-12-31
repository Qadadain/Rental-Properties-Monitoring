<?php

namespace App\Entity;

use App\Repository\RentalPropertyTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalPropertyTypeRepository::class)
 */
class RentalPropertyType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=RentalProperty::class, mappedBy="rentalPropertyType")
     */
    private $rentalProperty;

    public function __toString()
    {
        return $this->type;
    }

    public function __construct()
    {
        $this->rentalProperty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $rentalProperty->setRentalPropertyType($this);
        }

        return $this;
    }

    public function removeRentalProperty(RentalProperty $rentalProperty): self
    {
        if ($this->rentalProperty->removeElement($rentalProperty)) {
            // set the owning side to null (unless already changed)
            if ($rentalProperty->getRentalPropertyType() === $this) {
                $rentalProperty->setRentalPropertyType(null);
            }
        }

        return $this;
    }
}
