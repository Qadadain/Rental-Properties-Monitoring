<?php

namespace App\Form;

use App\Entity\Label;
use App\Entity\OperationType;
use App\Entity\Property;
use App\Entity\RentalProperty;
use App\Entity\RentalPropertyAccounting;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalPropertyAccountingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', MoneyType::class, [
                'label' => 'Montant :',
            ])
            ->add('date', DateType::class, [
                'label' => 'Date :',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])

            ->add('comment', TextType::class, [
                'label' => 'Commentaire :'
            ])
            ->add('operationType', EntityType::class, [
                'class' => OperationType::class,
                'label' => 'Type d\'opération :'
            ])
            ->add('label', EntityType::class, [
                'class' => Label::class,
                'label' => 'Libellé :'
            ])
            ->add('rentalProperty', EntityType::class, [
                'class' => RentalProperty::class,
                'label' => 'Propriété :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalPropertyAccounting::class,
        ]);
    }
}
