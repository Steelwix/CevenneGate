<?php

namespace App\Entity;

use App\Repository\BossRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BossRepository::class)]
class Boss
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'boss', cascade: ['persist', 'remove'])]
    private ?Character $character = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'bossBeaten')]
    private Collection $killedBy;

    #[ORM\OneToMany(mappedBy: 'dropOn', targetEntity: Relic::class)]
    private Collection $relics;

    public function __construct()
    {
        $this->killedBy = new ArrayCollection();
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

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getKilledBy(): Collection
    {
        return $this->killedBy;
    }

    public function addKilledBy(User $killedBy): self
    {
        if (!$this->killedBy->contains($killedBy)) {
            $this->killedBy->add($killedBy);
            $killedBy->addBossBeaten($this);
        }

        return $this;
    }

    public function removeKilledBy(User $killedBy): self
    {
        if ($this->killedBy->removeElement($killedBy)) {
            $killedBy->removeBossBeaten($this);
        }

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
            $relic->setDropOn($this);
        }

        return $this;
    }

    public function removeRelic(Relic $relic): self
    {
        if ($this->relics->removeElement($relic)) {
            // set the owning side to null (unless already changed)
            if ($relic->getDropOn() === $this) {
                $relic->setDropOn(null);
            }
        }

        return $this;
    }
}
