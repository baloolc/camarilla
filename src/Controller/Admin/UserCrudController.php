<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        $entityLabelSingular = 'Un utilisateur';
        $entityLabelPlurial = 'Tous les utilisateurs';

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
        $mediaUser = $this->getParameter('medias_user');
        $mediaUpload = 'uploads/userMedia/';

        yield TextField::new('firstname')->onlyOnIndex();
        yield TextField::new('lastname')->onlyOnIndex();
        yield DateTimeField::new('createdAt')->setLabel('Date de création')->onlyOnDetail();
        yield DateTimeField::new('updatedAt')->setLabel('Date de mise à jour')->onlyOnDetail();

        if(Crud::PAGE_EDIT){
            yield BooleanField::new('isActivate')->setLabel('Activation du compte')->onlyOnForms()->hideWhenCreating();
        yield ChoiceField::new('roles')
            ->setLabel('Rôle de l\'utilisateur')
            ->allowMultipleChoices()
            ->renderAsBadges([
                'ROLE_ADMIN' => 'success',
                'ROLE_STORYTELLER' => 'warning',
                'ROLE_CA' => 'info',
                'ROLE_DESK' => 'dark',
                'ROLE_MEMBER' => 'secondary'
            ])
            ->setChoices([
                'Administrateur' => 'ROLE_ADMIN',
                'Bureau' => 'ROLE_DESK',
                'CA' => 'ROLE_CA',
                'Conteur' => 'ROLE_STORYTELLER',
                'Utilisateur' => 'ROLE_MEMBER',
            ])
            ->hideWhenCreating();
        }
        if(Crud::PAGE_INDEX){
            yield BooleanField::new('isActivate')->addJsFiles()->setLabel('Activation du compte')->onlyOnIndex()->renderAsSwitch(false);
            yield ImageField::new('media', 'Image')
            ->setBasePath($mediaUpload)
            ->setUploadDir($mediaUser)
            ->setUploadedFileNamePattern('[firstname]-[uuid].[extension]')
            ->onlyOnIndex();
        }
    }
}
