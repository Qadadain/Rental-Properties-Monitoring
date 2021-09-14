<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\RentalProperty;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RentalPropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RentalProperty::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom :'),
            TextField::new('comment', 'Commentaire :'),
            AssociationField::new('property', 'Bien :'),
            AssociationField::new('rentalPropertyType', 'Type de propriété :')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Propriété')
            ->setSearchFields(['id', 'name', 'comment', 'property.name', 'rentalPropertyType.type']);
    }
}

