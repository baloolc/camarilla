<?php

namespace App\Model;

use Symfony\Component\Mailer\MailerInterface;

interface ActivateInterface
{
    public function isActivate(): ?bool;
    public function setIsActivate(?bool $isActivate): self;
    public function isVerified(): bool;
    public function getRoles(): array;
    public function setRoles(array $roles): self;

}