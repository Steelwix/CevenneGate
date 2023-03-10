<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?float $critDamage = null;

    #[ORM\OneToOne(inversedBy: 'character', cascade: ['persist', 'remove'])]
    private ?User $player = null;

    #[ORM\OneToOne(mappedBy: 'character', cascade: ['persist', 'remove'])]
    private ?Boss $boss = null;

    #[ORM\Column]
    private ?int $speed = 20;

    #[ORM\Column]
    private ?int $maxhp = 100;

    #[ORM\Column(nullable: true)]
    private ?int $mana = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxmana = null;

    #[ORM\ManyToMany(targetEntity: Relic::class, inversedBy: 'characters')]
    private Collection $relicOwned;

    public function __construct()
    {
        $this->relicOwned = new ArrayCollection();
    }

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

    public function getBoss(): ?Boss
    {
        return $this->boss;
    }

    public function setBoss(?Boss $boss): self
    {
        // unset the owning side of the relation if necessary
        if ($boss === null && $this->boss !== null) {
            $this->boss->setCharacter(null);
        }

        // set the owning side of the relation if necessary
        if ($boss !== null && $boss->getCharacter() !== $this) {
            $boss->setCharacter($this);
        }

        $this->boss = $boss;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getMaxhp(): ?int
    {
        return $this->maxhp;
    }

    public function setMaxhp(int $maxhp): self
    {
        $this->maxhp = $maxhp;

        return $this;
    }

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(?int $mana): self
    {
        $this->mana = $mana;

        return $this;
    }

    public function getMaxmana(): ?int
    {
        return $this->maxmana;
    }

    public function setMaxmana(?int $maxmana): self
    {
        $this->maxmana = $maxmana;

        return $this;
    }

    /**
     * @return Collection<int, Relic>
     */
    public function getRelicOwned(): Collection
    {
        return $this->relicOwned;
    }

    public function addRelicOwned(Relic $relicOwned): self
    {
        if (!$this->relicOwned->contains($relicOwned)) {
            $this->relicOwned->add($relicOwned);
        }

        return $this;
    }

    public function removeRelicOwned(Relic $relicOwned): self
    {
        $this->relicOwned->removeElement($relicOwned);

        return $this;
    }
}
