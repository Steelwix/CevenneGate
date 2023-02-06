<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToOne(mappedBy: 'player', cascade: ['persist', 'remove'])]
    private ?Character $character = null;

    #[ORM\ManyToMany(targetEntity: Boss::class, inversedBy: 'killedBy')]
    private Collection $bossBeaten;

    public function __construct()
    {
        $this->bossBeaten = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        // unset the owning side of the relation if necessary
        if ($character === null && $this->character !== null) {
            $this->character->setPlayer(null);
        }

        // set the owning side of the relation if necessary
        if ($character !== null && $character->getPlayer() !== $this) {
            $character->setPlayer($this);
        }

        $this->character = $character;

        return $this;
    }

    /**
     * @return Collection<int, Boss>
     */
    public function getBossBeaten(): Collection
    {
        return $this->bossBeaten;
    }

    public function addBossBeaten(Boss $bossBeaten): self
    {
        if (!$this->bossBeaten->contains($bossBeaten)) {
            $this->bossBeaten->add($bossBeaten);
        }

        return $this;
    }

    public function removeBossBeaten(Boss $bossBeaten): self
    {
        $this->bossBeaten->removeElement($bossBeaten);

        return $this;
    }
}
