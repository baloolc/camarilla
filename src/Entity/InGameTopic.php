<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\InGameTopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InGameTopicRepository::class)]
class InGameTopic implements TimestampedInterface
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
    private ?string $title;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content;

    #[Assert\Length(
        max: 255,
    )]
    #[Assert\File(
        maxSize: '500k',
        extensions: ['pdf', 'odt', 'docx', 'xlsx', 'ods'],
        extensionsMessage: 'Veuillez télécharger un fichier valide: pdf, docx, xlsx, odt, ods.',
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uploadFile = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $slug;

    #[Assert\DateTime]
    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at;

    #[Assert\DateTime]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[Assert\PositiveOrZero]
    #[Assert\NotBlank()]
    #[ORM\Column]
    private ?bool $is_read;

    #[ORM\ManyToOne(inversedBy: 'inGameTopics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?InGameCategory $inGameCategory = null;

    #[ORM\OneToMany(mappedBy: 'inGameTopic', targetEntity: InGameResponse::class, orphanRemoval: true)]
    private Collection $inGameResponses;

    public function __construct()
    {
        $this->inGameResponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getUploadFile(): ?string
    {
        return $this->uploadFile;
    }

    public function setUploadFile(?string $uploadFile): self
    {
        $this->uploadFile = $uploadFile;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isIsRead(): ?bool
    {
        return $this->is_read;
    }

    public function setIsRead(bool $is_read): self
    {
        $this->is_read = $is_read;

        return $this;
    }

    public function getInGameCategory(): ?InGameCategory
    {
        return $this->inGameCategory;
    }

    public function setInGameCategory(?InGameCategory $inGameCategory): self
    {
        $this->inGameCategory = $inGameCategory;

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
            $inGameResponse->setInGameTopic($this);
        }

        return $this;
    }

    public function removeInGameResponse(InGameResponse $inGameResponse): self
    {
        if ($this->inGameResponses->removeElement($inGameResponse)) {
            // set the owning side to null (unless already changed)
            if ($inGameResponse->getInGameTopic() === $this) {
                $inGameResponse->setInGameTopic(null);
            }
        }

        return $this;
    }
}
