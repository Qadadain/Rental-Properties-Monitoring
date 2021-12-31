<?php

namespace App\Controller;

use App\Entity\RentalProperty;
use App\Entity\RentalPropertyAccounting;
use App\Form\RentalPropertyAccountingType;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comptabilite-location", name="rental_property_accounting_")
 **/
class RentalPropertyAccountingController extends AbstractController
{
    /**
     * @Route ("/add", name="add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $rentalPropertyAccounting = new RentalPropertyAccounting();
        $form = $this->createForm(RentalPropertyAccountingType::class, $rentalPropertyAccounting);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rentalPropertyAccounting);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/rentalPropertyAccounting.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="show")
     * @param EntityManagerInterface $em
     * @param RentalProperty $rentalProperty
     * @param Request $request
     * @param DataTableFactory $dataTableFactory
     * @return Response
     */
    public function show(EntityManagerInterface $em, RentalProperty $rentalProperty, Request $request, DataTableFactory $dataTableFactory): Response
    {
        $rentalProperties =  $em->getRepository('App:RentalPropertyAccounting')->findBy(['rentalProperty' => $rentalProperty]);

        $rentalPropertiesAccounting = $em->getRepository('App:RentalPropertyAccounting')->findBy(
            ['rentalProperty' => $rentalProperty],
            ['date' => 'ASC']
        );

        foreach ($rentalProperties as $data){
            $rentalPropertyName = $data->getRentalProperty()->getName();
        }

        $results = [];
        foreach ($rentalPropertiesAccounting as $rentalPropertyAccounting) {
            $results[] = [
                'id' => $rentalPropertyAccounting->getId(),
                'label' => $rentalPropertyAccounting->getLabel(),
                'operationType' => $rentalPropertyAccounting->getOperationType(),
                'value' => ($rentalPropertyAccounting->getValue()),
                'date' => $rentalPropertyAccounting->getDate(),
                'comment' => $rentalPropertyAccounting->getComment(),
                'rentalProperty' => $rentalPropertyAccounting->getRentalProperty(),
            ];
        }

        $datatable = $dataTableFactory->create()
            ->add('id', TextColumn::class, [
                'label' => 'id.'
            ])
            ->add('label', TextColumn::class, [
                'label' => 'label',
                'orderable' => true
            ])
            ->add('operationType', TextColumn::class, [
                'label' => 'Type d\'opération',
                'orderable' => true
            ])
            ->add('value', TextColumn::class, [
                'label' => 'Montant',
                'orderable' => true
            ])
            ->add('date', DateTimeColumn::class, [
                'format' => 'd-m-Y',
                'label' => 'Date',
                'orderable' => true
            ])
            ->add('comment', TextColumn::class, [
                'label' => 'Commentaire',
            ])
            ->add('rentalProperty', TextColumn::class, [
                'label' => 'bien',
                'orderable' => true
            ]);

        $datatable->createAdapter(ArrayAdapter::class, $results);
        $datatable->handleRequest($request);

        if ($datatable->isCallback()) {
            return $datatable->getResponse();
        }

        return $this->render('show/rentalPropertyAccounting.html.twig', [
            'datatable' => $datatable,
            'rentalPropertyName' => $rentalPropertyName,
        ]);
    }

    /**
     * @Route("/show/all", name="show_all")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param DataTableFactory $dataTableFactory
     * @return Response
     */
    public function showAll(EntityManagerInterface $em, Request $request, DataTableFactory $dataTableFactory): Response
    {

        $rentalPropertiesAccounting = $em->getRepository('App:RentalPropertyAccounting')->findAll();

        $results = [];
        foreach ($rentalPropertiesAccounting as $rentalPropertyAccounting) {
            $results[] = [
                'id' => $rentalPropertyAccounting->getId(),
                'label' => $rentalPropertyAccounting->getLabel(),
                'operationType' => $rentalPropertyAccounting->getOperationType(),
                'value' => ($rentalPropertyAccounting->getValue()),
                'date' => $rentalPropertyAccounting->getDate(),
                'comment' => $rentalPropertyAccounting->getComment(),
                'rentalProperty' => $rentalPropertyAccounting->getRentalProperty(),
            ];
        }

        $datatable = $dataTableFactory->create()
            ->add('id', TextColumn::class, [
                'label' => 'id.'
            ])
            ->add('label', TextColumn::class, [
                'label' => 'label',
                'orderable' => true
            ])
            ->add('operationType', TextColumn::class, [
                'label' => 'Type d\'opération',
                'orderable' => true
            ])
            ->add('value', TextColumn::class, [
                'label' => 'Montant',
                'orderable' => true
            ])
            ->add('date', DateTimeColumn::class, [
                'format' => 'd-m-Y',
                'label' => 'Date',
                'orderable' => true
            ])
            ->add('comment', TextColumn::class, [
                'label' => 'Commentaire',
            ])
            ->add('rentalProperty', TextColumn::class, [
                'label' => 'location',
                'orderable' => true
            ]);

        $datatable->createAdapter(ArrayAdapter::class, $results);
        $datatable->handleRequest($request);

        if ($datatable->isCallback()) {
            return $datatable->getResponse();
        }

        return $this->render('show/allRentalPropertyAccounting.html.twig', [
            'datatable' => $datatable,
        ]);
    }
}
