<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
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
 * @Route("/bien", name="property_")
 */
class PropertyController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function propertyList(EntityManagerInterface $em): Response
    {
        $properties = $em->getRepository('App:Property');



        return $this->render('index/property.html.twig', [
            'properties' => $properties->findAll(),
        ]);
    }

    /**
     * @Route("/{slug}", name="show")
     */
    public function show(Property $property, EntityManagerInterface $em, ChartBuilderInterface $chartBuilder): Response
    {

        $rentalPropertiesRep = $em->getRepository('App:RentalProperty');
        $labelRep = $em->getRepository('App:Label');
        $propertyAccounting = $em->getRepository('App:PropertyAccounting');

        $rentalProperties = $rentalPropertiesRep->findBy(['property' => $property]);
        $propertyId = $property->getId();
        $labels = $labelRep->findAll();
        $labelNames = [];
        $labelColors = [];
        $propertySumByLabel = [];

        foreach ($labels as $label)
        {
            $labelId = $label->getId();
            $labelColors[] = $label->getColor();
            $labelNames[] = $label->getName();
            $propertySumByLabel[] = $propertyAccounting->getPropertySum($labelId, $propertyId);
        }


        $propertySumByLabel =  call_user_func_array('array_merge',$propertySumByLabel);
        $propertySumByLabel =  call_user_func_array('array_merge',$propertySumByLabel);

        $propertyAccountingChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $propertyAccountingChart->setData([
            'labels' => $labelNames,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => $labelColors,
                    'borderColor' => '#343a40',
                    'data' => $propertySumByLabel,
                ],
            ],
        ]);

        return $this->render('show/property.html.twig', [
            'property' => $property,
            'rentalProperties' => $rentalProperties,
            'propertyAccountingChart' => $propertyAccountingChart,
        ]);
    }


    /**
     * @Route ("/add", name="add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request, SluggerInterface $slugger): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $property->setSlug($slugger->slug(strtolower(strtolower($property->getName()))));
            $em->persist($property);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/property.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
