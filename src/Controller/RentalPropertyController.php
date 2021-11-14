<?php

namespace App\Controller;

use App\Entity\RentalProperty;
use App\Form\RentalPropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

/**
     * @Route("/location", name="rental_property_")
     */
class RentalPropertyController extends AbstractController
{
    /**
     * @Route ("/", name="index")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $rentalProperties = $em->getRepository('App:RentalProperty');

        return $this->render('index/rentalProperty.html.twig', [
            'rentalProperties' => $rentalProperties->findAll()
        ]);
    }

    /**
     * @Route ("/add", name="add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request, SluggerInterface  $slugger): Response
    {
        $rentalProperty = new RentalProperty();
        $form = $this->createForm(RentalPropertyType::class, $rentalProperty);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rentalProperty->setSlug($slugger->slug(strtolower(strtolower($rentalProperty->getName()))));
            $em->persist($rentalProperty);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/rentalProperty.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="show")
     */
    public function show(RentalProperty $rentalProperty, EntityManagerInterface $em, ChartBuilderInterface $chartBuilder): Response
    {
        $labelRep = $em->getRepository('App:Label');
        $rentalPropertiesAccounting = $em->getRepository('App:RentalPropertyAccounting');

        $labels = $labelRep->findAll();
        $rentalPropertyId = $rentalProperty->getId();

        $labelNames = [];
        $labelColors = [];
        $rentalPropertySumByLabel = [];

        foreach ($labels as $label) {
            $labelId = $label->getId();
            $labelColors[] = $label->getColor();
            $labelNames[] = $label->getName();
            $rentalPropertySumByLabel[] = $rentalPropertiesAccounting->getRentalPropertySum($labelId, $rentalPropertyId);
        }

        $rentalPropertySumByLabel =  call_user_func_array('array_merge',$rentalPropertySumByLabel);
        $rentalPropertySumByLabel =  call_user_func_array('array_merge',$rentalPropertySumByLabel);

        $rentalPropertyAccountingChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $rentalPropertyAccountingChart->setData([
            'labels' => $labelNames,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => $labelColors,
                    'borderColor' => '#343a40',
                    'data' => $rentalPropertySumByLabel,
                ],
            ],
        ]);


        return $this->render('show/rentalProperty.html.twig', [
            'rentalProperty' => $rentalProperty,
            'rentalPropertyAccountingChart' => $rentalPropertyAccountingChart,
        ]);
    }

}
