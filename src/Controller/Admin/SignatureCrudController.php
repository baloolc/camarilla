<?php

namespace App\Controller\Admin;

use App\Entity\Signature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class SignatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Signature::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'une signature';
        $entityLabelPlurial = 'Tous les signatures';

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
        yield TextField::new('descriptif')->setLabel('La signature du personnage (nom, status, clan, poste(s), reconnaissance(s) )');
        yield AssociationField::new('liveCharacter')->setLabel('Le personnage au quel la signature va être associer');
    }
}
