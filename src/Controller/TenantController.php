<?php

namespace App\Controller;

use App\Entity\Tenant;
use App\Form\TenantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tenant", name="tenant_")
 */
class TenantController extends AbstractController
{

    /**
     * @Route("/show", name="show")
     */
    public function show(EntityManagerInterface $em): Response
    {
        $tenants = $em->getRepository('App:Tenant')->findAll();

        return $this->render('show/tenant.html.twig', [
            'user' => $this->getUser(),
            'tenants' => $tenants,
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $tenant = new Tenant();
        $form = $this->createForm(TenantType::class, $tenant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tenant);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/tenant.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
