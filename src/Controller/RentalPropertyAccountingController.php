<?php

namespace App\Controller;

use App\Entity\PropertyAccounting;
use App\Entity\RentalPropertyAccounting;
use App\Form\PropertyAccountingType;
use App\Form\RentalPropertyAccountingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comptabilite-localisation", name="Rental_Property_Accounting_")
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
}
