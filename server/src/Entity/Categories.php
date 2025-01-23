<?php

// namespace App\Entity;

// use App\Repository\CategoriesRepository;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: CategoriesRepository::class)]
// class Categories
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(length: 255)]
//     private ?string $title = null;


//     /**
//      * @var Collection<int, Expenses>
//      */
//     #[ORM\OneToMany(targetEntity: Expenses::class, mappedBy: 'categories')]
//     private Collection $expenses;

//     public function __construct()
//     {
//         $this->expenses = new ArrayCollection();
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getTitle(): ?string
//     {
//         return $this->title;
//     }

//     public function setTitle(string $title): static
//     {
//         $this->title = $title;

//         return $this;
//     }

//     /**
//      * @return Collection<int, Expenses>
//      */
//     public function getExpenses(): Collection
//     {
//         return $this->expenses;
//     }

//     public function addExpense(Expenses $expense): static
//     {
//         if (!$this->expenses->contains($expense)) {
//             $this->expenses->add($expense);
//             $expense->setCategories($this);
//         }

//         return $this;
//     }

//     public function removeExpense(Expenses $expense): static
//     {
//         if ($this->expenses->removeElement($expense)) {
//             // set the owning side to null (unless already changed)
//             if ($expense->getCategories() === $this) {
//                 $expense->setCategories(null);
//             }
//         }

//         return $this;
//     }
// }

 namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['categories:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['categories:read'])]
    private ?string $title = null;

    /**
     * @var Collection<int, Expenses>
     */
    #[ORM\OneToMany(targetEntity: Expenses::class, mappedBy: 'categories')]
    #[Groups(['categories:read'])]
    private Collection $expenses;

    public function __construct()
    {
        $this->expenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Expenses>
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expenses $expense): static
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses->add($expense);
            $expense->setCategories($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): static
    {
        if ($this->expenses->removeElement($expense)) {
            if ($expense->getCategories() === $this) {
                $expense->setCategories(null);
            }
        }

        return $this;
    }
}