<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\RequestStack;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class CalendarCrudController extends AbstractCrudController
{
    private const MAXLENGHT = 5;

    public static function getEntityFqcn(): string
    {
        return Calendar::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'Une date';
        $entityLabelPlurial = 'Toutes les dates';

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
        yield TextField::new('name')->setLabel('Nom de l\'association');
        yield DateField::new('date')->renderAsNativeWidget(false)->setLabel('Date de l\'évènement');
        yield TextField::new('adress')->setLabel('Adresse');
        yield TextField::new('postalCode')->setLabel('Code postal')->setCustomOption(self::MAXLENGHT, null);
        yield TextField::new('country')->setLabel('Ville');
    }
}
