<?php

// namespace App\Entity;

// use App\Repository\ExpensesRepository;
// use Doctrine\DBAL\Types\Types;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: ExpensesRepository::class)]
// class Expenses
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column]
//     private ?float $amount = null;

//     #[ORM\Column(type: Types::DATETIME_MUTABLE)]
//     private ?\DateTimeInterface $date_expense = null;

//     #[ORM\Column(length: 255)]
//     private ?string $description = null;

//     #[ORM\ManyToOne(inversedBy: 'expenses')]
//     private ?Categories $categories = null;

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getAmount(): ?float
//     {
//         return $this->amount;
//     }

//     public function setAmount(float $amount): static
//     {
//         $this->amount = $amount;

//         return $this;
//     }

//     public function getDateExpense(): ?\DateTimeInterface
//     {
//         return $this->date_expense;
//     }

//     public function setDateExpense(\DateTimeInterface $date_expense): static
//     {
//         $this->date_expense = $date_expense;

//         return $this;
//     }

//     public function getDescription(): ?string
//     {
//         return $this->description;
//     }

//     public function setDescription(string $description): static
//     {
//         $this->description = $description;

//         return $this;
//     }

//     public function getCategories(): ?Categories
//     {
//         return $this->categories;
//     }

//     public function setCategories(?Categories $categories): static
//     {
//         $this->categories = $categories;

//         return $this;
//     }
// }

namespace App\Entity;

use App\Repository\ExpensesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExpensesRepository::class)]
class Expenses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['expense:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['expense:read'])]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['expense:read'])]
    private ?\DateTimeInterface $date_expense = null;

    #[ORM\Column(length: 255)]
    #[Groups(['expense:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[Groups(['expense:read'])]
    private ?Categories $categories = null;

        public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDateExpense(): ?\DateTimeInterface
    {
        return $this->date_expense;
    }

    public function setDateExpense(\DateTimeInterface $date_expense): static
    {
        $this->date_expense = $date_expense;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): static
    {
        $this->categories = $categories;

        return $this;
    }
}
