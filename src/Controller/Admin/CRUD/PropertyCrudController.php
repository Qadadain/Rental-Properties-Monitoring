<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use phpDocumentor\Reflection\Types\Integer;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom :'),
            TextField::new('city', 'Ville :'),
            IntegerField::new('zipCode', 'Code postal :'),
            TextField::new('address', 'Adresse :'),
            TextField::new('comment', 'Commentaire :'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Localisation')
            ->setSearchFields(['id', 'name', 'city', 'zipCode', 'address', 'comment', 'name']);
    }
}
