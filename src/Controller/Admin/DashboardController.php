<?php

namespace App\Controller\Admin;

use App\Entity\Advertisement;
use App\Entity\Character;
use App\Entity\Event;
use App\Entity\JobCategory;
use App\Entity\OffsideCategory;
use App\Entity\PraxisCategory;
use App\Entity\Presentation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct( 
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(EventCrudController::class)
        ->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Les terres d\'acionna');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retourner sur le site', 'fa fa-undo', 'home');

        yield MenuItem::subMenu('Association', 'fa-sharp fa-solid fa-house-laptop')->setSubItems([
            MenuItem::linkToCrud('Toutes les associations', 'fa-solid fa-igloo', Presentation::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Presentation::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Évènements', 'fa-regular fa-calendar-days')->setSubItems([
            MenuItem::linkToCrud('Tous les événements', 'fa-solid fa-users-rectangle', Event::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Event::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Annonces', 'fa-solid fa-rectangle-ad')->setSubItems([
            MenuItem::linkToCrud('Toutes les annonces', 'fa-solid fa-clipboard', Advertisement::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Advertisement::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Personnages', 'fa-sharp fa-solid fa-id-card')->setSubItems([
            MenuItem::linkToCrud('Tous les personnages', 'fa-solid fa-users', Character::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-person-circle-plus', Character::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Catégories hors jeu', 'fa-brands fa-discord')->setSubItems([
            MenuItem::linkToCrud('Toutes les catégories hors jeu', 'fa-solid fa-hippo', OffsideCategory::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', OffsideCategory::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Catégories de la praxis', 'fa-solid fa-dice-d20')->setSubItems([
            MenuItem::linkToCrud('Toutes les catégories en jeu', 'fa-solid fa-table-tennis-paddle-ball', PraxisCategory::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', PraxisCategory::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Catégories des postes', 'fa-solid fa-broom-ball')->setSubItems([
            MenuItem::linkToCrud('Toutes les catégories des postes', 'fa-brands fa-napster', JobCategory::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', JobCategory::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
}
