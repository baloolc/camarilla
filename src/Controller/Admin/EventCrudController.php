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
use Vich\UploaderBundle\Form\Type\VichImageType;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }


    public function configureFields(string $pageName): iterable
    {

        $mediaEvent = $this->getParameter('medias_event');
        $mediaUpload = 'uploads/eventMedia/';

        $sulgField = SlugField::new('slug')
            ->setTargetFieldName('title')
            ->setLabel('Barre de recherche: Automatique');

        $imagefield = ImageField::new('filename', 'Image')
            ->setBasePath($mediaUpload)
            ->setUploadDir($mediaEvent)
            ->hideWhenCreating();

        $vichImagefield = TextField::new('filenameFile')
            ->setFormType(VichImageType::class)
            ->setLabel('Télécharger une image')
            ->onlyWhenCreating();

        if (Crud::PAGE_EDIT === $pageName) {
            $sulgField->setLabel('Si édition copier/coller le titre');
            $imagefield->setRequired(false)->setLabel('Editer l\'image, mais ne peut pas être vide');
            $vichImagefield->setRequired(false);
        }

        yield TextField::new('title')->setLabel('Titre');
        yield $sulgField;
        yield DateField::new('eventDate')->renderAsNativeWidget(false)->setLabel('Date de l\'évènement');
        yield $imagefield;
        yield $vichImagefield;
        yield TextField::new('altText')->setLabel('Texte alternatif');
        yield TextEditorField::new('description')->setLabel('Description')->hideOnIndex();
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
    }
}
