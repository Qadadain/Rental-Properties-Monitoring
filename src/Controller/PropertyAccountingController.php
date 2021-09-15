<?php

namespace App\Controller;

use App\Entity\PropertyAccounting;
use App\Form\PropertyAccountingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/comptabilite-bien", name="Property_Accounting_")
 **/
class PropertyAccountingController extends AbstractController
{
    /**
     * @Route ("/add", name="add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $propertyAccounting = new PropertyAccounting();
        $form = $this->createForm(PropertyAccountingType::class, $propertyAccounting);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($propertyAccounting);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/propertyAccounting.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
