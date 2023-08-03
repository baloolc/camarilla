<?php

namespace App\Entity;

use App\Repository\CharacterMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterMediaRepository::class)]
class CharacterMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\OneToOne(inversedBy: 'characterMedia', cascade: ['persist', 'remove'])]
    private ?Character $personal = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPersonal(): ?Character
    {
        return $this->personal;
    }

    public function setPersonal(?Character $personal): self
    {
        $this->personal = $personal;

        return $this;
    }
}
