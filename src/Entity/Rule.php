<?php

namespace App\Entity;

use App\Repository\RuleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuleRepository::class)]
class Rule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titleOne = null;

    #[ORM\Column(length: 255)]
    private ?string $titleTwo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titleThree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $version = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $modificationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $autor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleOne(): ?string
    {
        return $this->titleOne;
    }

    public function setTitleOne(string $titleOne): self
    {
        $this->titleOne = $titleOne;

        return $this;
    }

    public function getTitleTwo(): ?string
    {
        return $this->titleTwo;
    }

    public function setTitleTwo(string $titleTwo): self
    {
        $this->titleTwo = $titleTwo;

        return $this;
    }

    public function getTitleThree(): ?string
    {
        return $this->titleThree;
    }

    public function setTitleThree(?string $titleThree): self
    {
        $this->titleThree = $titleThree;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modificationDate;
    }

    public function setModificationDate(\DateTimeInterface $modificationDate): self
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
