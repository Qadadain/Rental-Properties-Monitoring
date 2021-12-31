<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\RentalProperty;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('comment', TextType::class, [
                'label' => 'Commentaire :'
            ])
            ->add('rentalPropertyType', EntityType::class, [
                'class' => \App\Entity\RentalPropertyType::class,
                'label' => 'Type de location :'
            ])
            ->add('property', EntityType::class, [
                'class' => Property::class,
                'label' => 'Bien :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalProperty::class,
        ]);
    }
}
