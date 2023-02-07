<?php

namespace App\Controller\Admin;

use App\Entity\OffsideCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class OffsideCategoryCrudController extends AbstractCrudController
{

    private const MAXLENGHT = 50;

    public static function getEntityFqcn(): string
    {
        return OffsideCategory::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'une catégorie hors jeu';
        $entityLabelPlurial = 'Tous les catégories hors jeu';

        return $crud
            ->setEntityLabelInSingular($entityLabelSingular)
            ->setEntityLabelInPlural($entityLabelPlurial);
    }

    private function getSubMenuIndex()
    {
        return $this->requestStack->getMainRequest()->query->getInt('submenuIndex');
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->setLabel('Nom de la catégorie')->setCustomOption(self::MAXLENGHT, null);
        yield SlugField::new('slug')->hideOnForm()->setTargetFieldName('name');
    }
}
