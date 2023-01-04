<?php

namespace App\Controller\Admin;

use App\Entity\OffsideCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OffsideCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffsideCategory::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
