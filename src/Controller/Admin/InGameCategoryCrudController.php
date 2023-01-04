<?php

namespace App\Controller\Admin;

use App\Entity\InGameCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InGameCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InGameCategory::class;
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
