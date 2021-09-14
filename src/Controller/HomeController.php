<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="index")
     */
    public function home(): Response
    {
        $toto = 1;
        return $this->render('base.html.twig',[
            'toto' => $toto,
        ]);
    }
}
