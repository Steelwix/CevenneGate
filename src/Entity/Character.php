<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\Column]
    private ?int $physicalDamage = null;

    #[ORM\Column]
    private ?int $armor = null;

    #[ORM\Column]
    private ?float $critChance = null;

    #[ORM\Column]
    private ?int $critDamage = null;

    #[ORM\OneToOne(inversedBy: 'character', cascade: ['persist', 'remove'])]
    private ?User $player = null;

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

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getPhysicalDamage(): ?int
    {
        return $this->physicalDamage;
    }

    public function setPhysicalDamage(int $physicalDamage): self
    {
        $this->physicalDamage = $physicalDamage;

        return $this;
    }

    public function getArmor(): ?int
    {
        return $this->armor;
    }

    public function setArmor(int $armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    public function getCritChance(): ?float
    {
        return $this->critChance;
    }

    public function setCritChance(float $critChance): self
    {
        $this->critChance = $critChance;

        return $this;
    }

    public function getCritDamage(): ?int
    {
        return $this->critDamage;
    }

    public function setCritDamage(int $critDamage): self
    {
        $this->critDamage = $critDamage;

        return $this;
    }

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(?User $player): self
    {
        $this->player = $player;

        return $this;
    }
}
