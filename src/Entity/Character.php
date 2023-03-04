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
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[UniqueEntity(fields: ['name'])]
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
#[Vich\Uploadable]
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

    #[ORM\OneToOne(inversedBy: 'liveCharacter', cascade: ['persist', 'remove'])]
    private ?Signature $signature = null;

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

    #[Vich\UploadableField(mapping: 'character_avatar', fileNameProperty: 'characterAvatar')]
    #[Assert\File(

        maxSize: '500K',
    
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    
    )]
    private ?File $characterAvatarFile = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $characterAvatar = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?User $user = null;

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

    public function getSignature(): ?Signature
    {
        return $this->signature;
    }

    public function setSignature(?Signature $signature): self
    {
        $this->signature = $signature;

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

    public function __toString()
    {
        return $this->name;
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

    public function getCharacterAvatar(): ?string
    {
        return $this->characterAvatar;
    }

    public function setCharacterAvatar(?string $characterAvatar): self
    {
        $this->characterAvatar = $characterAvatar;

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

    public function setCharacterAvatarFile(File $image = null): Character

    {
        $this->characterAvatarFile = $image;

        return $this;
    }


    public function getCharacterAvatarFile(): ?File
    {

        return $this->characterAvatarFile;
    }
}
