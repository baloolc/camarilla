<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\InGameResponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InGameResponseRepository::class)]
class InGameResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\DateTime]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content;

    #[Assert\NotBlank()]
    #[ORM\ManyToOne(inversedBy: 'inGameResponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?InGameTopic $inGameTopic;

    #[ORM\ManyToOne(inversedBy: 'inGameResponses')]
    private ?Character $characterPlay = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getInGameTopic(): ?InGameTopic
    {
        return $this->inGameTopic;
    }

    public function setInGameTopic(?InGameTopic $inGameTopic): self
    {
        $this->inGameTopic = $inGameTopic;

        return $this;
    }

    public function getCharacterPlay(): ?Character
    {
        return $this->characterPlay;
    }

    public function setCharacterPlay(?Character $characterPlay): self
    {
        $this->characterPlay = $characterPlay;

        return $this;
    }
}
