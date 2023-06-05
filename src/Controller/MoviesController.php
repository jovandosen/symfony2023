<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
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
}
