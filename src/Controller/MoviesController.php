<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'title' => 'Terminator'
        ]);
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
