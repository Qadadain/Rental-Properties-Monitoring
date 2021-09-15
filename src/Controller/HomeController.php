<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

/**
 * @Route("/", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="index")
     */
    public function home(EntityManagerInterface $em, ChartBuilderInterface $chartBuilder): Response
    {
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }
        $labels = $em->getRepository('App:Label');
        $properties = $em->getRepository('App:Property');
        $rentalProperties = $em->getRepository('App:RentalProperty');
        $tenants = $em->getRepository('App:Tenant');
        $propertyAccounting = $em->getRepository('App:PropertyAccounting');
        $rentalPropertyAccounting = $em->getRepository('App:RentalPropertyAccounting');
        $rentReceipts = $em->getRepository('App:RentReceipt');

        $labels = $labels->findAll();
        $allRentalPropertiesSumByLabel = [];
        $allPropertiesSumByLabel = [];
        $labelNames = [];
        $labelColors = [];

        foreach ($labels as $label) {
            $labelId = $label->getId();
            $labelColors[] = $label->getColor();
            $allRentalPropertiesSumByLabel[] = $rentalPropertyAccounting->sumByLabel($labelId);
            $allPropertiesSumByLabel[] = $propertyAccounting->sumByLabel($labelId);
            $labelNames[] = $label->getName();
        }

        $allRentalPropertiesSumByLabel = call_user_func_array('array_merge', $allRentalPropertiesSumByLabel);
        $allRentalPropertiesSumByLabel = call_user_func_array('array_merge', $allRentalPropertiesSumByLabel);

        $allPropertiesSumByLabel = call_user_func_array('array_merge', $allPropertiesSumByLabel);
        $allPropertiesSumByLabel = call_user_func_array('array_merge', $allPropertiesSumByLabel);

        $propertyAccountingChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $propertyAccountingChart->setData([
            'labels' => $labelNames,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => $labelColors,
                    'borderColor' => '#343a40',
                    'data' => $allPropertiesSumByLabel,
                ],
            ],
        ]);

        $rentalPropertyAccountingChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $rentalPropertyAccountingChart->setData([
            'labels' => $labelNames,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => $labelColors,
                    'borderColor' => '#343a40',
                    'data' => $allRentalPropertiesSumByLabel,
                ],
            ],
        ]);

        $tenants = $tenants->findAll();
        $properties = $properties->findAll();
        $rentalProperties = $rentalProperties->findAll();
        $rentReceipts = $rentReceipts->findAll();
        $tenantsCount = count($tenants);
        $propertiesCount = count($properties);
        $locationsCount = count($rentalProperties);
        $rentReceiptsCount = count($rentReceipts);

        $totalPropertyAccounting = ($propertyAccounting->totalPropertyAccounting()[1]);
        $totalPropertyAccountingTwig = ($totalPropertyAccounting - ($totalPropertyAccounting * 2));
        $totalRentalPropertyAccounting = ($rentalPropertyAccounting->totalRentalPropertyAccounting()[1]);
        $benefit = ($totalRentalPropertyAccounting + $totalPropertyAccounting);

        return $this->render('home.html.twig', [
            'tenantsCount' => $tenantsCount,
            'locationsCount' => $locationsCount,
            'propertiesCount' => $propertiesCount,
            'sumPropertyAccounting' => $totalPropertyAccountingTwig,
            'sumRentalPropertyAccounting' => $totalRentalPropertyAccounting,
            'benefit' => $benefit,
            'rentReceiptsCount' => $rentReceiptsCount,
            'propertiesChart' => $propertyAccountingChart,
            'rentalPropertiesChart' => $rentalPropertyAccountingChart,
        ]);
    }
}
