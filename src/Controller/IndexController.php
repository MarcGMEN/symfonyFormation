<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/root", name="roor   ")
     */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', 
            [
                'controller_name' => 'mon IndexController',
            ]
        );
    }

    /**
     * @Route("/bonjour", name="bonjour")
     */
    public function bonjour(): Response
    {
        return $this->render('index/index.html.twig', 
            [
                'controller_name' => 'bonjour',
            ]
        );
    }

    /**
     * @Route("/bjr", name="bjr")
     */
    public function direBonjour(): Response {
        /*return new Response(
                '<h2>Bonjour</h2>'
        );*/
        return $this->render('index/bjr.html.twig', 
            [     'monParam' => 'Mon bonjour from controler...' 
            ] 
        );
    }
}