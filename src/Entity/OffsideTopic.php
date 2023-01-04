<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\OffsideTopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffsideTopicRepository::class)]
class OffsideTopic implements TimestampedInterface
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

    #[Assert\DateTime]
    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $slug;

    #[Assert\DateTime]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[Assert\PositiveOrZero]
    #[Assert\NotBlank()]
    #[ORM\Column]
    private ?bool $is_read;

    #[ORM\ManyToOne(inversedBy: 'offsideTopics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OffsideCategory $offsideCategory = null;

    #[ORM\OneToMany(mappedBy: 'offsideTopic', targetEntity: OffsideResponse::class, orphanRemoval: true)]
    private Collection $offsideResponses;

    public function __construct()
    {
        $this->offsideResponses = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
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

    public function getOffsideCategory(): ?OffsideCategory
    {
        return $this->offsideCategory;
    }

    public function setOffsideCategory(?OffsideCategory $offsideCategory): self
    {
        $this->offsideCategory = $offsideCategory;

        return $this;
    }

    /**
     * @return Collection<int, OffsideResponse>
     */
    public function getOffsideResponses(): Collection
    {
        return $this->offsideResponses;
    }

    public function addOffsideResponse(OffsideResponse $offsideResponse): self
    {
        if (!$this->offsideResponses->contains($offsideResponse)) {
            $this->offsideResponses->add($offsideResponse);
            $offsideResponse->setOffsideTopic($this);
        }

        return $this;
    }

    public function removeOffsideResponse(OffsideResponse $offsideResponse): self
    {
        if ($this->offsideResponses->removeElement($offsideResponse)) {
            // set the owning side to null (unless already changed)
            if ($offsideResponse->getOffsideTopic() === $this) {
                $offsideResponse->setOffsideTopic(null);
            }
        }

        return $this;
    }
}
