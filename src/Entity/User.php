<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    #[Assert\Length(
        max: 180
    )]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Assert\Length(
        max: 255
    )]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 200,
    )]
    #[ORM\Column(length: 200)]
    private ?string $lastname;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 200,
    )]
    #[ORM\Column(length: 200)]
    private ?string $firstname;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Character::class)]
    private Collection $character_id;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'user_id')]
    private Collection $events;

    #[ORM\ManyToMany(targetEntity: Offside::class, mappedBy: 'user_id')]
    private Collection $offsides;

    public function __construct()
    {
        $this->character_id = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->offsides = new ArrayCollection();
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacterId(): Collection
    {
        return $this->character_id;
    }

    public function addCharacterId(Character $characterId): self
    {
        if (!$this->character_id->contains($characterId)) {
            $this->character_id->add($characterId);
            $characterId->setUser($this);
        }

        return $this;
    }

    public function removeCharacterId(Character $characterId): self
    {
        if ($this->character_id->removeElement($characterId)) {
            // set the owning side to null (unless already changed)
            if ($characterId->getUser() === $this) {
                $characterId->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->addUserId($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Offside>
     */
    public function getOffsides(): Collection
    {
        return $this->offsides;
    }

    public function addOffside(Offside $offside): self
    {
        if (!$this->offsides->contains($offside)) {
            $this->offsides->add($offside);
            $offside->addUserId($this);
        }

        return $this;
    }

    public function removeOffside(Offside $offside): self
    {
        if ($this->offsides->removeElement($offside)) {
            $offside->removeUserId($this);
        }

        return $this;
    }
}
