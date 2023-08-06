<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


class CharacterRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $characterName = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $clan = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $secte = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $status = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $pattern = null;

    public function getCharacterName(): ?string
    {
        return $this->characterName;
    }

    public function setCharacterName(string $characterName): self
    {
        $this->characterName = $characterName;

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

    public function getSecte(): ?string
    {
        return $this->secte;
    }

    public function setSecte(string $secte): self
    {
        $this->secte = $secte;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function setPattern(string $pattern): self
    {
        $this->pattern = $pattern;

        return $this;
    }
}