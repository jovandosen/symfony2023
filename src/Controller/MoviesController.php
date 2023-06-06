<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    // private $em;

    // public function __construct(EntityManagerInterface $em)
    // {
    //     $this->em = $em;
    // }

    #[Route('/movies-foo', name: 'app_movies_foo')]
    public function indexFoo(): Response
    {
        // findAll() -> SELECT * FROM movies;
        // find() -> SELECT * FROM movies WHERE id = 5;
        // findBy() -> SELECT * FROM movies ORDER BY id DESC;
        // findOneBy() -> SELECT * FROM movies WHERE id = 5 AND releaseYear = 2008 ORDER BY id DESC
        // count() -> SELECT COUNT(id) FROM movie;
        // getClassName() -> App\Entity\Movie

        $repository = $this->em->getRepository(Movie::class);

        return $this->render('index.html.twig');
    }

    #[Route('/movies-test/{name}', name: 'app_movies_test', defaults: ['name' => null], methods: ['GET', 'HEAD'])]
    public function indexTest($name): JsonResponse
    {
        return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
    
    /**
     * oldMethod
     *
     * @Route("old", name="old")
     */
    public function oldMethod(): JsonResponse
    {
        return $this->json([
            'message' => 'Old method.',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }

    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    #[Route('/movies', methods: ['GET'], name: 'app_movies')]
    public function index(): Response
    {
        $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig', ['movies' => $movies, 'user' => new stdClass()]);
    }

    #[Route('/movies/{id}', methods: ['GET'], name: 'app_movie')]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);

        return $this->render('movies/show.html.twig', ['movie' => $movie, 'user' => new stdClass()]);
    }
}
