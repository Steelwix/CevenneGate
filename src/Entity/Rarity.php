<?php

namespace App\Entity;

use App\Repository\RarityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RarityRepository::class)]
class Rarity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\OneToMany(mappedBy: 'rarity', targetEntity: Relic::class)]
    private Collection $relics;

    public function __construct()
    {
        $this->relics = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Relic>
     */
    public function getRelics(): Collection
    {
        return $this->relics;
    }

    public function addRelic(Relic $relic): self
    {
        if (!$this->relics->contains($relic)) {
            $this->relics->add($relic);
            $relic->setRarity($this);
        }

        return $this;
    }

    public function removeRelic(Relic $relic): self
    {
        if ($this->relics->removeElement($relic)) {
            // set the owning side to null (unless already changed)
            if ($relic->getRarity() === $this) {
                $relic->setRarity(null);
            }
        }

        return $this;
    }
}
