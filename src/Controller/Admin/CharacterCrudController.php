<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\HttpFoundation\RequestStack;

class CharacterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Character::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'un personnage';
        $entityLabelPlurial = 'Tous les personnages';

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
        yield TextField::new('name')->setLabel('Nom du personnage');
        yield UrlField::new('linkCharacter')->setLabel('Lien de la fiche personnage');
        yield ChoiceField::new('ageStatus')->setLabel('Status d\'âge')->autocomplete()->setChoices([
            'Infant sous tutelle' => 'Infant sous tutelle',
            'Nouveau née' => 'Nouveau née',
            'Ancilla' => 'Ancilla',
            'Ancien' => 'Ancien',
            'Vénérable' => 'Vénérable',
            'Anarch' => 'Anarch',
        ]);
        yield ChoiceField::new('clan')->setLabel('Votre clan')->autocomplete()->setChoices([
            'Nosferatu' => 'Nosferatu',
            'Ventrue' => 'Ventrue',
            'Gangrel' => 'Gangrel',
            'Brujah' => 'Brujah',
            'Toréador' => 'Toréador',
            'Malkavian' => 'Malkavian',
            'Trémère' => 'Trémère',
            'Ravnos' => 'Ravnos',
            'Giovani' => 'Giovani',
            'Assamite' => 'Assamite',
            'Settite' => 'Settite',
            'Lasombra' => 'Lasombra',
            'Caïtif' => 'Caïtif',
        ]);
        yield DateTimeField::new('createdAt')->hideOnForm();
    }
}