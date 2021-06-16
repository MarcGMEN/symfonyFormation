<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/film", name="film_")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }
    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
            $filRepo= new FilmRepository();
        return $this->render('film/list.html.twig', [
                "films" => $filRepo->getAll()
            ]
        );
    }

    /**
     * @Route("/listJson", name="listJson")
     */
    public function listJson(): Response
    {
        $filRepo= new FilmRepository();
        return new JsonResponse($filRepo->getAll());
        
    }

     /**
     * @Route("/get/{idFilm}", name="get", requirements={"idFilm"="\d+"})
     */
    public function getFilm($idFilm): Response
    {
        $filRepo= new FilmRepository();
        $fiche = $filRepo->get($idFilm);
        return $this->render('film/fiche.html.twig', [
            'laFiche' => $fiche
        ]);
    }
}
