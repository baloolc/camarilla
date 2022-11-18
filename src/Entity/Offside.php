<?php

namespace App\Entity;

use App\Repository\OffsideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffsideRepository::class)]
class Offside
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(
        max: 200
    )]
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $offsideCategory = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_response = null;

    #[ORM\ManyToMany(targetEntity: USER::class, inversedBy: 'offsides')]
    private Collection $user_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffsideCategory(): ?string
    {
        return $this->offsideCategory;
    }

    public function setOffsideCategory(?string $offsideCategory): self
    {
        $this->offsideCategory = $offsideCategory;

        return $this;
    }

    public function isIsResponse(): ?bool
    {
        return $this->is_response;
    }

    public function setIsResponse(?bool $is_response): self
    {
        $this->is_response = $is_response;

        return $this;
    }

    /**
     * @return Collection<int, USER>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(USER $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(USER $userId): self
    {
        $this->user_id->removeElement($userId);

        return $this;
    }
}
