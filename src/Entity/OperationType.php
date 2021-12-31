<?php

namespace App\Entity;

use App\Repository\OperationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationTypeRepository::class)
 */
class OperationType
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=PropertyAccounting::class, mappedBy="operationType")
     */
    private $propertyAccountings;

    /**
     * @ORM\OneToMany(targetEntity=RentalPropertyAccounting::class, mappedBy="operationType")
     */
    private $rentalPropertyAccountings;

    public function __toString()
    {
        return $this->type;
    }

    public function __construct()
    {
        $this->propertyAccountings = new ArrayCollection();
        $this->rentalPropertyAccountings = new ArrayCollection();
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
     * @return Collection|PropertyAccounting[]
     */
    public function getPropertyAccountings(): Collection
    {
        return $this->propertyAccountings;
    }

    public function addPropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if (!$this->propertyAccountings->contains($propertyAccounting)) {
            $this->propertyAccountings[] = $propertyAccounting;
            $propertyAccounting->setOperationType($this);
        }

        return $this;
    }

    public function removePropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if ($this->propertyAccountings->removeElement($propertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($propertyAccounting->getOperationType() === $this) {
                $propertyAccounting->setOperationType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RentalPropertyAccounting[]
     */
    public function getRentalPropertyAccountings(): Collection
    {
        return $this->rentalPropertyAccountings;
    }

    public function addRentalPropertyAccounting(RentalPropertyAccounting $rentalPropertyAccounting): self
    {
        if (!$this->rentalPropertyAccountings->contains($rentalPropertyAccounting)) {
            $this->rentalPropertyAccountings[] = $rentalPropertyAccounting;
            $rentalPropertyAccounting->setOperationType($this);
        }

        return $this;
    }

    public function removeRentalPropertyAccounting(RentalPropertyAccounting $rentalPropertyAccounting): self
    {
        if ($this->rentalPropertyAccountings->removeElement($rentalPropertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($rentalPropertyAccounting->getOperationType() === $this) {
                $rentalPropertyAccounting->setOperationType(null);
            }
        }

        return $this;
    }
}
