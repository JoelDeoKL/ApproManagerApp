<?php

namespace App\Entity;

use App\Repository\DeclarationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeclarationRepository::class)]
class Declaration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $qte_achete = null;

    #[ORM\Column(length: 255)]
    private ?string $qte_vendue = null;

    #[ORM\ManyToOne(inversedBy: 'declarations')]
    private ?Produit $produit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_declaration = null;

    #[ORM\ManyToMany(targetEntity: Stock::class, mappedBy: 'declaration')]
    private Collection $stocks;

    #[ORM\Column(length: 255)]
    private ?string $nature = null;

    #[ORM\ManyToOne(inversedBy: 'declarations')]
    private ?User $user = null;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteAchete(): ?string
    {
        return $this->qte_achete;
    }

    public function setQteAchete(string $qte_achete): static
    {
        $this->qte_achete = $qte_achete;

        return $this;
    }

    public function getQteVendue(): ?string
    {
        return $this->qte_vendue;
    }

    public function setQteVendue(string $qte_vendue): static
    {
        $this->qte_vendue = $qte_vendue;

        return $this;
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

    public function getDateDeclaration(): ?\DateTimeInterface
    {
        return $this->date_declaration;
    }

    public function setDateDeclaration(\DateTimeInterface $date_declaration): static
    {
        $this->date_declaration = $date_declaration;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->addDeclaration($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            $stock->removeDeclaration($this);
        }

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): static
    {
        $this->nature = $nature;

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
