<?php

namespace App\Controller\Admin;

use App\Entity\InGameResponse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InGameResponseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InGameResponse::class;
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
