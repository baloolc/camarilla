<?php

namespace App\EventSubscriber;

use App\Model\SlugInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SlugSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEntitySlug'],
        ];
    }

    public function setEntitySlug(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof SlugInterface){
            return;
        }

        $name = $entity->getName();
        $nameModif = str_replace(' ', '-', $name);
        $slug = trim($nameModif);
        
        $entity->setSlug($slug);
    }
}