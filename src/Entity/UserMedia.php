<?php

namespace App\Entity;

use App\Repository\UserMediaRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File as File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserMediaRepository::class)]
class UserMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\File(

        maxSize: '500K',

        mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'],

    )]
    private ?string $avatar;

    #[ORM\OneToOne(inversedBy: 'userMedia', cascade: ['persist', 'remove'])]
    private ?User $user;

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
