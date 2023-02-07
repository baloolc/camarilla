<?php

namespace App\Controller\Admin;

use App\Entity\JobCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class JobCategoryCrudController extends AbstractCrudController
{
    private const MAXLENGHT = 50;

    public static function getEntityFqcn(): string
    {
        return JobCategory::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'une catégorie de poste';
        $entityLabelPlurial = 'Tous les catégories des postes';

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
        yield $sulgField = SlugField::new('slug')->hideOnForm()->setTargetFieldName('name');
        yield TextEditorField::new('description')->setLabel('Description du lieu ou du poste');
        yield ArrayField::new('participant')->setLabel('Membres du poste')->hideOnIndex(); 
    }
}
