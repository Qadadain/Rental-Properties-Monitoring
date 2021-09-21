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
    public function show(Property $property, EntityManagerInterface $em): Response
    {
        $rentalProperties = $em->getRepository('App:RentalProperty')->findBy(['property' => $property]);


        return $this->render('show/property.html.twig', [
            'property' => $property,
            'rentalProperties' => $rentalProperties,
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
