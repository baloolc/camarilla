<?php

namespace App\Controller\Admin;

use App\Entity\Presentation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class PresentationCrudController extends AbstractCrudController
{
    private const MAX_LENGHT_TEXT = 100;
    private const MAX_LENGHT = 255;
    
    public static function getEntityFqcn(): string
    {
        return Presentation::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'une présentation d\'association';
        $entityLabelPlurial = 'Toutes les présentations d\'association';

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
        yield TextField::new('name')->setLabel('Nom')->setCustomOption(self::MAX_LENGHT_TEXT, null);
        yield TextEditorField::new('content')->setLabel('Contenu')->hideOnIndex();
        yield TextField::new('adress')->setLabel('Adresse complète')->setCustomOption(self::MAX_LENGHT, null);
        yield EmailField::new('email')->setLabel('Email');
        
    }
}
