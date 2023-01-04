<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[Assert\Url]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $linkCharacter = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $ageStatus;

    #[ORM\Column(type: Types::TEXT, length: 255,nullable: true)]
    private ?string $recognized = null;

    #[ORM\ManyToOne(inversedBy: 'character')]
    private ?User $user = null;

    #[Assert\PositiveOrZero]
    #[Assert\NotBlank()]
    #[ORM\Column()]
    private ?bool $is_harpie;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $job = null;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $clan = null;

    #[Assert\PositiveOrZero]
    #[Assert\NotBlank()]
    #[ORM\Column()]
    private ?bool $is_validate;

    #[Assert\DateTime]
    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at;

    #[ORM\OneToMany(mappedBy: 'characterPlay', targetEntity: InGameResponse::class)]
    private Collection $inGameResponses;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $label = null;

    public function __construct()
    {
        $this->inGameResponses = new ArrayCollection();
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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

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

    public function isHarpie(): ?bool
    {
        return $this->is_harpie;
    }

    public function setIsHarpie(?bool $is_harpie): self
    {
        $this->is_harpie = $is_harpie;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

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

    public function isIsValidate(): ?bool
    {
        return $this->is_validate;
    }

    public function setIsValidate(?bool $is_validate): self
    {
        $this->is_validate = $is_validate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, InGameResponse>
     */
    public function getInGameResponses(): Collection
    {
        return $this->inGameResponses;
    }

    public function addInGameResponse(InGameResponse $inGameResponse): self
    {
        if (!$this->inGameResponses->contains($inGameResponse)) {
            $this->inGameResponses->add($inGameResponse);
            $inGameResponse->setCharacterPlay($this);
        }

        return $this;
    }

    public function removeInGameResponse(InGameResponse $inGameResponse): self
    {
        if ($this->inGameResponses->removeElement($inGameResponse)) {
            // set the owning side to null (unless already changed)
            if ($inGameResponse->getCharacterPlay() === $this) {
                $inGameResponse->setCharacterPlay(null);
            }
        }

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
