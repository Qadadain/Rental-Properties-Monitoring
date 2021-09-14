<?php

namespace App\Controller\Admin;

use App\Entity\Label;
use App\Entity\OperationType;
use App\Entity\Property;
use App\Entity\PropertyAccounting;
use App\Entity\RentalProperty;
use App\Entity\RentalPropertyAccounting;
use App\Entity\RentalPropertyType;
use App\Entity\RentReceipt;
use App\Entity\Tenant;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loca Gestion');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Index', 'fa fa-home', 'home_index');

        yield MenuItem::section('CRUD', 'fas fa-cogs');
        yield MenuItem::linkToCrud('Utilisateur ', 'fa fa-user', User::class);

        yield MenuItem::section('Les biens', 'far fa-building');

        yield MenuItem::linkToCrud('Biens ', 'fas fa-map-marker-alt', Property::class);
        yield MenuItem::linkToCrud('Locations', 'fa fa-home', RentalProperty::class);
        yield MenuItem::linkToCrud('Locataire', 'fa fa-home', Tenant::class);

        yield MenuItem::section('Ligne compta', 'fas fa-calculator');

        yield MenuItem::linkToCrud('Compta Biens', 'fas fa-map-marker-alt', PropertyAccounting::class);
        yield MenuItem::linkToCrud('Compta Locations', 'fa fa-home', RentalPropertyAccounting::class);
        yield MenuItem::linkToCrud('Quittance de loyer', 'fa fa-home', RentReceipt::class);

        yield MenuItem::section('Gestions', 'fas fa-database');

        yield MenuItem::linkToCrud('Type de propriété', 'fas fa-warehouse', RentalPropertyType::class);
        yield MenuItem::linkToCrud('Type d\'opération', 'fas fa-exchange-alt', OperationType::class);
        yield MenuItem::linkToCrud('Label', 'fas fa-tag', Label::class);
    }
}

