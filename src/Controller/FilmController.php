<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmArrayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilmRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/film", name="film_")
 */
class FilmController extends AbstractController
{

    private $_repoFilm;

    public function __construct(FilmRepository $filrepp) {
        $this->_repoFilm = $filrepp;
    }
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
            $filRepo= new FilmArrayRepository();
        return $this->render('film/list.html.twig', [
                "films" => $filRepo->getAll()
            ]
        );
    }
     /**
     * @Route("/listSQLLite", name="listSQLLite")
     */
    public function listSQLLite(): Response
    {
           // Chercher le repository de Movie
        //  $lesFilms = $this->getDoctrine()
        //->getRepository(Film::class)
        //->findAll();
      $lesFilms =$this->_repoFilm->findAll();
      if ($lesFilms) {
      return $this->render('film/list.html.twig', [
        "films" => $lesFilms        ]    );
      }
      else {
          throw $this->createNotFoundException("Aucun films");
      }

    }

    /**
     * @Route("/listJson", name="listJson")
     */
    public function listJson(): Response
    {
        $filRepo= new FilmArrayRepository();
        return new JsonResponse($filRepo->getAll());
        
    }

     /**
     * @Route("/get/{idFilm}", name="get", requirements={"idFilm"="\d+"})
     */
    public function getFilm($idFilm): Response
    {
        $filRepo= new FilmArrayRepository();
        $fiche = $filRepo->get($idFilm);
        return $this->render('film/fiche.html.twig', [
            'laFiche' => $fiche
        ]);
    }

      /**
     * @Route("/getSQL/{idFilm}", name="getSQL", requirements={"idFilm"="\d+"})
     */
    public function getFilmSQL($idFilm): Response
    {
        $fiche = $this->getDoctrine()
        ->getRepository(Film::class)->find($idFilm);
      //  $fiche = $this->repoFilm->find($idFilm);
        return $this->render('film/fiche.html.twig', [
            'laFiche' => $fiche
        ]);
    }

     /**
     * @Route("/add", name="add")
     * 
     */
    public function add(EntityManagerInterface $em): Response
    {
        $film = new Film([ "titre" => "titre from sqlite1"]);
        $film->setGenre("null comme film");
        $film->setSynopsis("smfsgfhsdlkhdslkghdslkghdslkds");


        //utilisation de l'entityMangar pour les requetesde bases
        $em->persist($film);
        $em->flush();

    // redirection vers la page des lists
        return $this->redirectToRoute('film_list');
    }

     /**
     * @Route("/addForm", name="addForm")
     * 
     */
    public function addForm(Request $request , EntityManagerInterface $em): Response
    {
        $film = new Film();


        $formAddFilm = $this->createFormBuilder($film)
        ->add('titre', TextType::class)
        ->add('synopsis', TextareaType::class)
        ->add('genre', TextType::class)
        ->add('poster', UrlType::class,
         ['attr' => ["placeHolder"=> "http://"]])
        ->add('Save', SubmitType::class, ['label' => "Enregister le film"] )->getForm();


        // prise en compte de la reponse
        $formAddFilm->handleRequest($request);

        if ($formAddFilm->isSubmitted()) {
            $film=$formAddFilm->getData();
            //utilisation de l'entityMangar pour les requetesde bases
        $em->persist($film);
        $em->flush();

    // redirection vers la page des lists
        return $this->redirectToRoute('film_listSQLLite');
        }
        else {

        return $this->render('film/ficheAdd.html.twig', [
            'formAddFilm' => $formAddFilm->createView()
        ]);
    }

    }
}
