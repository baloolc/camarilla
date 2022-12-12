<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
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
    private ?string $name;

    #[Assert\PositiveOrZero]
    #[ORM\Column(nullable: true)]
    private ?int $menuOrder = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: OffsideCategory::class)]
    private Collection $offsideCategory;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: InGameCategory::class)]
    private Collection $inGameCategory;

    public function __construct()
    {
        $this->offsideCategory = new ArrayCollection();
        $this->inGameCategory = new ArrayCollection();
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

    public function getMenuOrder(): ?int
    {
        return $this->menuOrder;
    }

    public function setMenuOrder(?int $menuOrder): self
    {
        $this->menuOrder = $menuOrder;

        return $this;
    }

    /**
     * @return Collection<int, OffsideCategory>
     */
    public function getOffsideCategory(): Collection
    {
        return $this->offsideCategory;
    }

    public function addOffsideCategory(OffsideCategory $offsideCategory): self
    {
        if (!$this->offsideCategory->contains($offsideCategory)) {
            $this->offsideCategory->add($offsideCategory);
            $offsideCategory->setMenu($this);
        }

        return $this;
    }

    public function removeOffsideCategory(OffsideCategory $offsideCategory): self
    {
        if ($this->offsideCategory->removeElement($offsideCategory)) {
            // set the owning side to null (unless already changed)
            if ($offsideCategory->getMenu() === $this) {
                $offsideCategory->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InGameCategory>
     */
    public function getInGameCategory(): Collection
    {
        return $this->inGameCategory;
    }

    public function addInGameCategory(InGameCategory $inGameCategory): self
    {
        if (!$this->inGameCategory->contains($inGameCategory)) {
            $this->inGameCategory->add($inGameCategory);
            $inGameCategory->setMenu($this);
        }

        return $this;
    }

    public function removeInGameCategory(InGameCategory $inGameCategory): self
    {
        if ($this->inGameCategory->removeElement($inGameCategory)) {
            // set the owning side to null (unless already changed)
            if ($inGameCategory->getMenu() === $this) {
                $inGameCategory->setMenu(null);
            }
        }

        return $this;
    }
}
