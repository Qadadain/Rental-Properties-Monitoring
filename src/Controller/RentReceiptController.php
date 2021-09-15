<?php

namespace App\Controller;

use App\Entity\RentReceipt;
use App\Form\RentReceiptType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/quittance-de-loyer", name="rent_receipt_")
 */
class RentReceiptController extends AbstractController
{

    /**
     * @Route("/add", name="add")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $rentReceipt = new RentReceipt();
        $form = $this->createForm(RentReceiptType::class, $rentReceipt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rentReceipt);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/rentReceipt.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
