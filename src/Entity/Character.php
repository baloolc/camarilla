<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\CharacterRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Model\SlugInterface;
use DateTimeInterface;

#[UniqueEntity(fields: ['name'])]
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character implements TimestampedInterface, SlugInterface
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

    #[Assert\Url]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $linkCharacter = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $ageStatus;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: JobCategory::class, inversedBy: 'characters')]
    private Collection $jobs;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $clan = null;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    #[ORM\Column(nullable: true)]
    private array $job = [];

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?User $user = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $recognize = null;

    #[ORM\OneToOne(mappedBy: 'personal', cascade: ['persist', 'remove'])]
    private ?CharacterMedia $characterMedia = null;

    #[ORM\Column(length: 10)]
    private ?string $secte = null;

    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->jobs = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, JobCategory>
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJobs(JobCategory $jobs): self
    {
        if (!$this->jobs->contains($jobs)) {
            $this->jobs->add($jobs);
        }

        return $this;
    }

    public function removeJobs(JobCategory $jobs): self
    {
        $this->jobs->removeElement($jobs);

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getJob(): array
    {
        return $this->job;
    }

    public function setJob(?array $job): self
    {
        $this->job = $job;

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

    public function __toString()
    {
        return $this->name;
    }

    public function getRecognize(): ?string
    {
        return $this->recognize;
    }

    public function setRecognize(?string $recognize): self
    {
        $this->recognize = $recognize;

        return $this;
    }

    public function getCharacterMedia(): ?CharacterMedia
    {
        return $this->characterMedia;
    }

    public function setCharacterMedia(?CharacterMedia $characterMedia): self
    {
        // unset the owning side of the relation if necessary
        if ($characterMedia === null && $this->characterMedia !== null) {
            $this->characterMedia->setPersonal(null);
        }

        // set the owning side of the relation if necessary
        if ($characterMedia !== null && $characterMedia->getPersonal() !== $this) {
            $characterMedia->setPersonal($this);
        }

        $this->characterMedia = $characterMedia;

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
}
