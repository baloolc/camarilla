<?php

namespace App\Entity;

use App\Repository\OffsideCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name'])]
#[ORM\Entity(repositoryClass: OffsideCategoryRepository::class)]
class OffsideCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100, unique: true)]
    private ?string $name;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $slug;

    #[ORM\OneToMany(mappedBy: 'offsideCategory', targetEntity: OffsideTopic::class, orphanRemoval: true)]
    private Collection $offsideTopics;

    #[ORM\ManyToOne(inversedBy: 'offsideCategory')]
    private ?Menu $menu = null;

    public function __construct()
    {
        $this->offsideTopics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, OffsideTopic>
     */
    public function getOffsideTopics(): Collection
    {
        return $this->offsideTopics;
    }

    public function addOffsideTopic(OffsideTopic $offsideTopic): self
    {
        if (!$this->offsideTopics->contains($offsideTopic)) {
            $this->offsideTopics->add($offsideTopic);
            $offsideTopic->setOffsideCategory($this);
        }

        return $this;
    }

    public function removeOffsideTopic(OffsideTopic $offsideTopic): self
    {
        if ($this->offsideTopics->removeElement($offsideTopic)) {
            // set the owning side to null (unless already changed)
            if ($offsideTopic->getOffsideCategory() === $this) {
                $offsideTopic->setOffsideCategory(null);
            }
        }

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
