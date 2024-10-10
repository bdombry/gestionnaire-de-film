<?php

namespace App\Controller;

use App\Entity\Films;
use App\Repository\FilmsRepository;
use App\Service\SlugifyService;
use App\Service\OmdbService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film')]
    public function index(FilmsRepository $repository): Response
    {
        // Récupérer tous les films
        $films = $repository->findAll();

        return $this->render('film/index.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/film/{slug}', name: 'film.show_by_slug')]
    public function showBySlug(string $slug, FilmsRepository $repository): Response
    {
        // Rechercher le film par slug
        $film = $repository->findBySlug($slug);

        if (!$film) {
            throw $this->createNotFoundException('Film non trouvé');
        }

        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }

}
