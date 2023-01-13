<?php

namespace App\Controller\Admin;

use App\Entity\Advertisement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class AdvertisementCrudController extends AbstractCrudController
{
    private const MAXLENGHT = 50;

    public static function getEntityFqcn(): string
    {
        return Advertisement::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'une annonce';
        $entityLabelPlurial = 'Tous les annonces';

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
        $sulgField = SlugField::new('slug')
        ->setTargetFieldName('title')
        ->setLabel('Barre de recherche: Automatique');

        if (Crud::PAGE_EDIT === $pageName) {
           
            $sulgField->setLabel('Si édition copier/coller le titre');
        }

        yield TextField::new('title')->setLabel('Titre')->setCustomOption(self::MAXLENGHT, null);
        yield $sulgField;
        yield DateField::new('advertisementDate')->renderAsNativeWidget(false)->setLabel('Date de l\'annonce');
        yield TextEditorField::new('content')->setLabel('Contenu')->hideOnIndex();
        yield DateTimeField::new('createdAt')->setLabel('Date de création')->hideOnForm();
        yield DateTimeField::new('updatedAt')->setLabel('Date de mise à jour')->hideOnForm();
    }
}
