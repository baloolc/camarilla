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
use Symfony\Component\HttpFoundation\RequestStack;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EventCrudController extends AbstractCrudController
{
    private const MAXLENGHT = 100;

    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'un évènnement';
        $entityLabelPlurial = 'Tous les évènnements';

        return $crud
        ->setEntityLabelInSingular($entityLabelSingular)
        ->setEntityLabelInPlural($entityLabelPlurial)
        ;
    }

    private function getSubMenuIndex()
    {
        return $this->requestStack->getMainRequest()->query->getInt('submenuIndex');
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
            ->setUploadedFileNamePattern('[slug]-[uuid].[extension]')
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

        yield TextField::new('title')->setLabel('Titre')->setCustomOption(self::MAXLENGHT, null);
        yield $sulgField;
        yield DateField::new('eventDate')->renderAsNativeWidget(false)->setLabel('Date de l\'évènement');
        yield $imagefield;
        yield $vichImagefield;
        yield TextField::new('altText')->setLabel('Texte alternatif')->setCustomOption(self::MAXLENGHT, null);
        yield TextEditorField::new('description')->setLabel('Description')->hideOnIndex();
        yield DateTimeField::new('createdAt')->setLabel('Date de création')->hideOnForm();
        yield DateTimeField::new('updatedAt')->setLabel('Date de mise à jour')->hideOnForm();
    }
}
