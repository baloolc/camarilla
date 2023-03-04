<?php

namespace App\EventSubscriber;

use App\Model\ActivateInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class ActivateSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityUpdatedEvent::class => ['entityIsActivate'],
        ];
    }

    public function entityIsActivate(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof ActivateInterface) {
            return;
        }

        if ($entity->isActivate() === false && $entity->isVerified() === false) {
            $entity->setRoles(['ROLE_USER']);
        } elseif ($entity->isActivate() === false && $entity->isVerified() === true) {
            $entity->setRoles(['ROLE_USER']);
        } elseif ($entity->isActivate() === true && $entity->isVerified() === false) {
            $entity->setIsActivate(false);
            $entity->setRoles(['ROLE_USER']);
        } elseif ($entity->isActivate() === true && $entity->isVerified() === true) {
            $role = $entity->getRoles();
            $entity->setRoles($role);
        }
    }
}
