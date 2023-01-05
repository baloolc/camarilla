<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $mediaEvent = $this->getParameter('medias_event');
        $uploadsEvent = $this->getParameter('uploads_event');

        $imagefield = ImageField::new('filename', 'Image')
        ->setBasePath($uploadsEvent)
        ->setUploadDir($mediaEvent)
        ->setUploadedFileNamePattern('[slug]-[uuid].[extention]');

        if(Crud::PAGE_EDIT === $pageName) {
            $imagefield->setRequired(false);
        }

        yield TextField::new('title')->setLabel('Titre');
        yield SlugField::new('slug')->setTargetFieldName('title')->setLabel('Titre de l\'onglet automatique sauf en édition faire un copier coller du titre')->hideOnIndex();
        yield DateField::new('eventDate')->renderAsNativeWidget(false)->setLabel('Date de l\'évènement');
        yield $imagefield;
        yield TextField::new('altText')->setLabel('Texte alternatif')->hideOnIndex();
        yield TextEditorField::new('description')->setLabel('Description');
        yield DateTimeField::new('createdAt')->hideOnForm();

    }
}
