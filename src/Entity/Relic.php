<?php

namespace App\Entity;

use App\Repository\RelicRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelicRepository::class)]
class Relic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $component = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'relics')]
    private ?Boss $dropOn = null;

    #[ORM\ManyToOne(inversedBy: 'relics')]
    private ?Rarity $rarity = null;

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

    public function getComponent(): ?string
    {
        return $this->component;
    }

    public function setComponent(?string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDropOn(): ?Boss
    {
        return $this->dropOn;
    }

    public function setDropOn(?Boss $dropOn): self
    {
        $this->dropOn = $dropOn;

        return $this;
    }

    public function getRarity(): ?Rarity
    {
        return $this->rarity;
    }

    public function setRarity(?Rarity $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }
}
