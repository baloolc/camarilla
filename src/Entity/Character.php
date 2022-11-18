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

    #[Assert\Length(
        max: 200,
    )]
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $name = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[Assert\Url]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $link = null;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $clan = null;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ageStatus = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_validate = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $recognized = null;

    #[ORM\ManyToOne(inversedBy: 'character_id')]
    private ?User $user = null;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getClan(): ?string
    {
        return $this->clan;
    }

    public function setClan(?string $clan): self
    {
        $this->clan = $clan;

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

    public function isIsValidate(): ?bool
    {
        return $this->is_validate;
    }

    public function setIsValidate(?bool $is_validate): self
    {
        $this->is_validate = $is_validate;

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
}
