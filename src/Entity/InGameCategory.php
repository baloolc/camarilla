<?php

namespace App\Entity;

use App\Repository\InGameCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name'])]
#[ORM\Entity(repositoryClass: InGameCategoryRepository::class)]
class InGameCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100,  unique: true)]
    private ?string $name;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(length: 100)]
    private ?string $slug;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'inGameCategory', targetEntity: InGameTopic::class, orphanRemoval: true)]
    private Collection $inGameTopics;

    #[ORM\ManyToOne(inversedBy: 'inGameCategory')]
    private ?Menu $menu = null;

    public function __construct()
    {
        $this->inGameTopics = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, InGameTopic>
     */
    public function getInGameTopics(): Collection
    {
        return $this->inGameTopics;
    }

    public function addInGameTopic(InGameTopic $inGameTopic): self
    {
        if (!$this->inGameTopics->contains($inGameTopic)) {
            $this->inGameTopics->add($inGameTopic);
            $inGameTopic->setInGameCategory($this);
        }

        return $this;
    }

    public function removeInGameTopic(InGameTopic $inGameTopic): self
    {
        if ($this->inGameTopics->removeElement($inGameTopic)) {
            // set the owning side to null (unless already changed)
            if ($inGameTopic->getInGameCategory() === $this) {
                $inGameTopic->setInGameCategory(null);
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
