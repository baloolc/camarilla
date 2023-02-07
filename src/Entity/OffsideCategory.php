<?php

namespace App\Entity;

use App\Repository\OffsideCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: OffsideCategoryRepository::class)]
#[UniqueEntity(fields: ['name'])]
class OffsideCategory 
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
}
