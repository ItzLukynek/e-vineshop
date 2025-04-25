<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Jméno je povinné.")]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Příjmení je povinné.")]
    private ?string $lastName = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Telefon je povinný.")]
    #[Assert\Regex(
        pattern: '/^\+?[0-9 ]{6,20}$/',
        message: 'Zadejte platné telefonní číslo.'
    )]
    private ?string $phone = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "Popis objednávky je povinný.")]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $specialNotes = null;

    #[ORM\Column(nullable: true)]
    private ?int $minPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxPrice = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: "E-mail je povinný.")]
    #[Assert\Email(message: "Zadejte platný e-mail.")]
    private ?string $email = null;

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getId(): ?int { return $this->id; }

    public function getFirstName(): ?string { return $this->firstName; }
    public function setFirstName(string $firstName): static { $this->firstName = $firstName; return $this; }

    public function getLastName(): ?string { return $this->lastName; }
    public function setLastName(string $lastName): static { $this->lastName = $lastName; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(string $phone): static { $this->phone = $phone; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): static { $this->description = $description; return $this; }

    public function getSpecialNotes(): ?string { return $this->specialNotes; }
    public function setSpecialNotes(?string $specialNotes): static { $this->specialNotes = $specialNotes; return $this; }

    public function getMinPrice(): ?int { return $this->minPrice; }
    public function setMinPrice(?int $minPrice): static { $this->minPrice = $minPrice; return $this; }

    public function getMaxPrice(): ?int { return $this->maxPrice; }
    public function setMaxPrice(?int $maxPrice): static { $this->maxPrice = $maxPrice; return $this; }
}
