<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TimestampedInterface
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
    #[Assert\NotBlank()]
    #[ORM\Column]
    private ?string $password;

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
    private Collection $characters;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userAvatar = null;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'user_id')]
    private Collection $events;

    #[Assert\NotBlank()]
    #[Assert\DateTime]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at;

    #[Assert\PositiveOrZero]
    #[Assert\NotBlank()]
    #[ORM\Column()]
    private ?bool $is_activate;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OffsideResponse::class)]
    private Collection $offsideResponses;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->offsideResponses = new ArrayCollection();
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
     * @return Collection<int, Characters>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacters(Character $characters): self
    {
        if (!$this->characters->contains($characters)) {
            $this->characters->add($characters);
            $characters->setUser($this);
        }

        return $this;
    }

    public function removeCharacters(Character $characters): self
    {
        if ($this->characters->removeElement($characters)) {
            // set the owning side to null (unless already changed)
            if ($characters->getUser() === $this) {
                $characters->setUser(null);
            }
        }

        return $this;
    }

    public function getUserAvatar(): ?string
    {
        return $this->userAvatar;
    }

    public function setUserAvatar(?string $userAvatar): self
    {
        $this->userAvatar = $userAvatar;

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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isIsActivate(): ?bool
    {
        return $this->is_activate;
    }

    public function setIsActivate(?bool $is_activate): self
    {
        $this->is_activate = $is_activate;

        return $this;
    }

    /**
     * @return Collection<int, OffsideResponse>
     */
    public function getOffsideResponses(): Collection
    {
        return $this->offsideResponses;
    }

    public function addOffsideResponse(OffsideResponse $offsideResponse): self
    {
        if (!$this->offsideResponses->contains($offsideResponse)) {
            $this->offsideResponses->add($offsideResponse);
            $offsideResponse->setUser($this);
        }

        return $this;
    }

    public function removeOffsideResponse(OffsideResponse $offsideResponse): self
    {
        if ($this->offsideResponses->removeElement($offsideResponse)) {
            // set the owning side to null (unless already changed)
            if ($offsideResponse->getUser() === $this) {
                $offsideResponse->setUser(null);
            }
        }

        return $this;
    }
}
