<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\CharacterRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name'])]
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character implements TimestampedInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 200,
    )]
    #[ORM\Column(length: 200, unique: true)]
    private ?string $name;

    #[Assert\Url]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $linkCharacter = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $ageStatus;

    #[ORM\ManyToOne(inversedBy: 'character')]
    private ?User $user = null;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $clan = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
