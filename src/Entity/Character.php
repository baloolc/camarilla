<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 200,
    )]
    #[ORM\Column(length: 200)]
    private ?string $name;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[Assert\Url]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $linkCharacter = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $ageStatus;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $recognized = null;

    #[ORM\ManyToOne(inversedBy: 'character_id')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_harpie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $clan = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_validate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getLinkCharacter(): ?string
    {
        return $this->linkCharacter;
    }

    public function setLinkCharacter(?string $linkCharacter): self
    {
        $this->linkCharacter = $linkCharacter;

        return $this;
    }

    public function getAgeStatus(): ?string
    {
        return $this->ageStatus;
    }

    public function setAgeStatus(?string $ageStatus): self
    {
        $this->ageStatus = $ageStatus;

        return $this;
    }

    public function getRecognized(): ?string
    {
        return $this->recognized;
    }

    public function setRecognized(?string $recognized): self
    {
        $this->recognized = $recognized;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isHarpie(): ?bool
    {
        return $this->is_harpie;
    }

    public function setIsHarpie(?bool $is_harpie): self
    {
        $this->is_harpie = $is_harpie;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getClan(): ?string
    {
        return $this->clan;
    }

    public function setClan(string $clan): self
    {
        $this->clan = $clan;

        return $this;
    }

    public function isIsValidate(): ?bool
    {
        return $this->is_validate;
    }

    public function setIsValidate(?bool $is_validate): self
    {
        $this->is_validate = $is_validate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
