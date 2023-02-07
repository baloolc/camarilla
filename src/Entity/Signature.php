<?php

namespace App\Entity;

use App\Repository\SignatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignatureRepository::class)]
class Signature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $recognized = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $job = null;

    #[ORM\OneToOne(mappedBy: 'signature', cascade: ['persist', 'remove'])]
    private ?Character $liveCharacter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecognized(): ?string
    {
        return $this->recognized;
    }

    public function setRecognized(?string $recognized): self
    {
        $this->recognized = $recognized;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getLiveCharacter(): ?Character
    {
        return $this->liveCharacter;
    }

    public function setLiveCharacter(?Character $liveCharacter): self
    {
        // unset the owning side of the relation if necessary
        if ($liveCharacter === null && $this->liveCharacter !== null) {
            $this->liveCharacter->setSignature(null);
        }

        // set the owning side of the relation if necessary
        if ($liveCharacter !== null && $liveCharacter->getSignature() !== $this) {
            $liveCharacter->setSignature($this);
        }

        $this->liveCharacter = $liveCharacter;

        return $this;
    }
}
