<?php


// src/Entity/Vehicle.php
namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $brand;

    #[ORM\Column(type: 'string', length: 255)]
    private $modele;

    #[ORM\Column(type: 'date')]
    private $immatDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $immatNumber;

    #[ORM\ManyToOne(targetEntity: Owner::class, inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private $owner;

    #[ORM\Column(type: 'json', nullable: true)]
    private $features = [];

    // Ajoutez ici d'autres propriétés et méthodes selon les besoins

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getImmatDate(): ?\DateTimeInterface
    {
        return $this->immatDate;
    }

    public function setImmatDate(\DateTimeInterface $immatDate): self
    {
        $this->immatDate = $immatDate;

        return $this;
    }

    public function getImmatNumber(): ?string
    {
        return $this->immatNumber;
    }

    public function setImmatNumber(string $immatNumber): self
    {
        $this->immatNumber = $immatNumber;

        return $this;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setFeatures(?array $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
