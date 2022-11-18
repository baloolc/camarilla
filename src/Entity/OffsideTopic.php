<?php

namespace App\Entity;

use App\Repository\OffsideTopicRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffsideTopicRepository::class)]
class OffsideTopic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 255
    )]
    #[ORM\Column(length: 255)]
    private ?string $topicTitle = null;

    #[Assert\NotBlank()]
    #[Assert\DateTime]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $topicDate = null;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $topicText = null;

    #[ORM\ManyToOne(inversedBy: 'offsideTopic_id')]
    private ?Offside $offside = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTopicTitle(): ?string
    {
        return $this->topicTitle;
    }

    public function setTopicTitle(string $topicTitle): self
    {
        $this->topicTitle = $topicTitle;

        return $this;
    }

    public function getTopicDate(): ?\DateTimeInterface
    {
        return $this->topicDate;
    }

    public function setTopicDate(\DateTimeInterface $topicDate): self
    {
        $this->topicDate = $topicDate;

        return $this;
    }

    public function getTopicText(): ?string
    {
        return $this->topicText;
    }

    public function setTopicText(string $topicText): self
    {
        $this->topicText = $topicText;

        return $this;
    }

    public function getOffside(): ?Offside
    {
        return $this->offside;
    }

    public function setOffside(?Offside $offside): self
    {
        $this->offside = $offside;

        return $this;
    }
}
