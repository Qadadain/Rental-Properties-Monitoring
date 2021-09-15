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

    /**
     * @Route("/location", name="rental_property_")
     */
class RentalPropertyController extends AbstractController
{

    /**
     * @Route ("/add", name="add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $rentalProperty = new RentalProperty();
        $form = $this->createForm(RentalPropertyType::class, $rentalProperty);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rentalProperty);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/rentalProperty.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
