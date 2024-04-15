<?php

namespace App\Entity;

use App\Repository\PokedexRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokedexRepository::class)]
class Pokedex
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $evolution = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statistique = null;

    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $atk = [];

    #[ORM\Column]
    private ?int $defense = null;

    #[ORM\Column]
    private ?int $weight = null;

    #[ORM\Column]
    private ?int $height = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getEvolution(): ?string
    {
        return $this->evolution;
    }

    public function setEvolution(string $evolution): static
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getStatistique(): ?string
    {
        return $this->statistique;
    }

    public function setStatistique(?string $statistique): static
    {
        $this->statistique = $statistique;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAtk(): array
    {
        return $this->atk;
    }

    public function setAtk(array $atk): static
    {
        $this->atk = $atk;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
