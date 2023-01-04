<?php

namespace App\Controller\Admin;

use App\Entity\OffsideTopic;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OffsideTopicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffsideTopic::class;
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
