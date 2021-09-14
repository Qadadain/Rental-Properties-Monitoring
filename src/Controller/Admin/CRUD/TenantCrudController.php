<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Tenant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TenantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tenant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName', 'Prénom :'),
            TextField::new('lastName', 'Nom :'),
            DateField::new('entry', 'Entrée'),
            DateField::new('leaveAccommodation', 'Départ :'),
            AssociationField::new('rentalProperty', 'Location'),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Locataire')
            ->setSearchFields(['id', 'firstName', 'lastName', 'entry', 'leaveAccommodation', 'rentalProperty.name']);
    }
}
