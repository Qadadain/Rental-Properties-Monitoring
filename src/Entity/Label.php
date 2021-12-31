<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabelRepository::class)
 */
class Label
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
    private $name;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=PropertyAccounting::class, mappedBy="label")
     */
    private $propertyAccountings;

    /**
     * @ORM\OneToMany(targetEntity=RentalPropertyAccounting::class, mappedBy="label")
     */
    private $rentalPropertyAccountings;

    public function __toString()
    {
        return $this->name;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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
            $propertyAccounting->setLabel($this);
        }

        return $this;
    }

    public function removePropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if ($this->propertyAccountings->removeElement($propertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($propertyAccounting->getLabel() === $this) {
                $propertyAccounting->setLabel(null);
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
            $rentalPropertyAccounting->setLabel($this);
        }

        return $this;
    }

    public function removeRentalPropertyAccounting(RentalPropertyAccounting $rentalPropertyAccounting): self
    {
        if ($this->rentalPropertyAccountings->removeElement($rentalPropertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($rentalPropertyAccounting->getLabel() === $this) {
                $rentalPropertyAccounting->setLabel(null);
            }
        }

        return $this;
    }
}
