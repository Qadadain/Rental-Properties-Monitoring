<?php

namespace App\Entity;

use App\Repository\RentalPropertyAccountingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalPropertyAccountingRepository::class)
 */
class RentalPropertyAccounting
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
    private $value;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=OperationType::class, inversedBy="rentalPropertyAccountings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operationType;

    /**
     * @ORM\ManyToOne(targetEntity=Label::class, inversedBy="rentalPropertyAccountings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity=RentalProperty::class, inversedBy="rentalPropertyAccounting")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rentalProperty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getOperationType(): ?OperationType
    {
        return $this->operationType;
    }

    public function setOperationType(?OperationType $operationType): self
    {
        $this->operationType = $operationType;

        return $this;
    }

    public function getLabel(): ?Label
    {
        return $this->label;
    }

    public function setLabel(?Label $label): self
    {
        $this->label = $label;

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
