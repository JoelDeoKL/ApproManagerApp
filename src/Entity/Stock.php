<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Produit $produit = null;

    #[ORM\Column(length: 255)]
    private ?string $quantite = null;

    #[ORM\ManyToMany(targetEntity: Declaration::class, inversedBy: 'stocks')]
    private Collection $declaration;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?User $user = null;

    public function __construct()
    {
        $this->declaration = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Declaration>
     */
    public function getDeclaration(): Collection
    {
        return $this->declaration;
    }

    public function addDeclaration(Declaration $declaration): static
    {
        if (!$this->declaration->contains($declaration)) {
            $this->declaration->add($declaration);
        }

        return $this;
    }

    public function removeDeclaration(Declaration $declaration): static
    {
        $this->declaration->removeElement($declaration);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
