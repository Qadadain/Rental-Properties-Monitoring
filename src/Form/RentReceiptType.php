<?php

namespace App\Form;

use App\Entity\RentReceipt;
use App\Entity\Tenant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentReceiptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rent', MoneyType::class, [
                'label' => 'Loyer :',
            ])
            ->add('advancesOnCharges', MoneyType::class, [
                'label' => 'Avances sur charges :',
            ])
            ->add('total', MoneyType::class, [
                'label' => 'Total :',
            ])
            ->add('startRent', DateType::class, [
                'label' => 'Loyer du :',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('endRent', DateType::class, [
                'label' => 'Au :',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('rentalNumber', TextType::class, [
                'label' => 'N° Locat :'
            ])
            ->add('date', DateType::class, [
                'label' => 'Au :',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('tenant', EntityType::class,[
                'class' => Tenant::class,
                'label' => 'Locataire :',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentReceipt::class,
        ]);
    }
}
