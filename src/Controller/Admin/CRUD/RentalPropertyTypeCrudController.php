<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\RentalPropertyType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RentalPropertyTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RentalPropertyType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('type', 'Type :'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Type de propriété')
            ->setSearchFields(['id', 'type']);
    }
}
