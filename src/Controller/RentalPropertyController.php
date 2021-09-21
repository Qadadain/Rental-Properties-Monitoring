<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\RentalProperty;
use App\Form\RentalPropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
     * @Route("/location", name="rental_property_")
     */
class RentalPropertyController extends AbstractController
{

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
    public function show(RentalProperty $rentalProperty): Response
    {


        return $this->render('show/rentalProperty.html.twig', [
            'rentalProperty' => $rentalProperty,
        ]);
    }

}
