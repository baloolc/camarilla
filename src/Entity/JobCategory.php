<?php

namespace App\Entity;

use App\Repository\JobCategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JobCategoryRepository::class)]
class JobCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  #[Assert\Length(
        max: 50
    )]
    #[Assert\NotBlank()]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[Assert\Length(
        max: 60
    )]
    #[Assert\NotBlank()]
    #[ORM\Column(length: 60)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $participant = [];

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getParticipant(): array
    {
        return $this->participant;
    }

    public function setParticipant(?array $participant): self
    {
        $this->participant = $participant;

        return $this;
    }
}
