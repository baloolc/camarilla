<?php

namespace App\Entity;

use App\Model\SlugInterface;
use App\Model\TimestampedInterface;
use App\Repository\EventRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[Vich\Uploadable]
class Event implements TimestampedInterface, SlugInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description;

    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $altText = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt;

    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $slug;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $eventDate = null;

    #[Vich\UploadableField(mapping: 'event_file', fileNameProperty: 'filename')]
    #[Assert\File(

        maxSize: '500K',
    
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    
    )]
    private ?File $filenameFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(length: 255)]
    private ?string $filename = '';

    #[Assert\PositiveOrZero]
    #[ORM\Column(nullable: true)]
    private ?int $nbParticipant = null;

    #[Assert\Length(
        max: 50,
    )]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column(nullable: true)]
    private ?int $nbMaybe = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column(nullable: true)]
    private ?int $nbNoParticipant = null;

    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAltText(): ?string
    {
        return $this->altText;
    }

    public function setAltText(string $altText): self
    {
        $this->altText = $altText;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): ?self
    {
        if (empty($filename)){
            $filename ='';
        }
            $this->filename = $filename;

        return $this;
    }

    public function getNbParticipant(): ?int
    {
        return $this->nbParticipant;
    }

    public function setNbParticipant(?int $nbParticipant): self
    {
        $this->nbParticipant = $nbParticipant;

        return $this;
    }

    public function setFilenameFile(File $filenameFile = null): Event

    {
        $this->filenameFile = $filenameFile;

        return $this;
    }


    public function getFilenameFile(): ?File
    {

        return $this->filenameFile;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNbMaybe(): ?int
    {
        return $this->nbMaybe;
    }

    public function setNbMaybe(?int $nbMaybe): self
    {
        $this->nbMaybe = $nbMaybe;

        return $this;
    }

    public function getNbNoParticipant(): ?int
    {
        return $this->nbNoParticipant;
    }

    public function setNbNoParticipant(?int $nbNoParticipant): self
    {
        $this->nbNoParticipant = $nbNoParticipant;

        return $this;
    }
}
