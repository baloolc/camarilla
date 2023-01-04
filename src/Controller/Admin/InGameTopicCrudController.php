<?php

namespace App\Controller\Admin;

use App\Entity\InGameTopic;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InGameTopicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InGameTopic::class;
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
