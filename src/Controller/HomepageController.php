<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage_movies")
     */
    public function movies(MovieRepository $movieRepository): Response
    {
        // Récupérer tous les films depuis la base de données
        $movies = $movieRepository->findAll();

        // Passer les films à la vue
        return $this->render('Home.html.twig', [
            'movies' => $movies,
        ]);
    }
}
