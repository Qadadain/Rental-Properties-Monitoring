<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\RentReceipt;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RentReceiptCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RentReceipt::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            MoneyField::new('rent', 'Loyer :')->setCurrency('EUR')->setStoredAsCents(false),
            MoneyField::new('advancesOnCharges', 'Avances sur charges :')->setCurrency('EUR')->setStoredAsCents(false),
            MoneyField::new('total', 'Total :')->setCurrency('EUR')->setStoredAsCents(false),
            DateField::new('startRent', 'Loyer du :'),
            DateField::new('endRent', 'Au :'),
            TextField::new('rentalNumber', 'Numéro locataire :'),
            DateField::new('date', 'Au :'),
            AssociationField::new('tenant', 'Locataire :'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Quittance de loyer')
            ->setSearchFields(['id', 'rent', 'advancesOnCharges', 'total', 'startRent', 'endRent', 'rentalNumber', 'date', 'tenant.firstName' ]);
    }

}
