<?php

namespace App\Model;


interface SlugInterface
{
    public function getSlug(): ?string;
    public function setSlug(string $sulg): self;
    public function getName(): ?string;

}