<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Property;
use App\Form\LocationType;
use App\Form\PropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bien", name="property_")
 */
class PropertyController extends AbstractController
{
    /**
     * @Route ("/add", name="add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $location = new Property();
        $form = $this->createForm(PropertyType::class, $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($location);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/property.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
