<?php

namespace App\Entity;

use App\Repository\OffsideTopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    #[ORM\Column(type: Types::TEXT)]
    private ?string $topicContent = null;

    #[ORM\ManyToOne(inversedBy: 'offsideTopic_id')]
    private ?Offside $offside = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'replies')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $replies;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }

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

    public function getTopicContent(): ?string
    {
        return $this->topicContent;
    }

    public function setTopicText(string $topicContent): self
    {
        $this->topicContent = $topicContent;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(self $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setParent($this);
        }

        return $this;
    }

    public function removeReply(self $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getParent() === $this) {
                $reply->setParent(null);
            }
        }

        return $this;
    }
}
