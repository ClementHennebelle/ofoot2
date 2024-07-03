<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TournamentController extends AbstractController
{
    #[Route('/tournament', name: 'app_tournament_browse', methods:"GET")]
    public function browse(): Response
    {
        return $this->render('tournament/index.html.twig', [
            'controller_name' => 'TournamentController',
        ]);
    }


    #[Route('/tournament/{id}', name: 'app_tournament_read', methods:"GET", requirements: ["id" => "\d+"])]
    public function read(): Response
    {
        return $this->render('tournament/index.html.twig', [
            'controller_name' => 'TournamentController',
        ]);
    }
}
