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
        return $this->render('tournament/home.html.twig', [
            'controller_name' => 'TournamentController',
        ]);
    }


    #[Route('/tournament/{id}', name: 'app_tournament_read', methods:"GET", requirements: ["id" => "\d+"])]
    public function read(): Response
    {
        return $this->render('tournament/read.html.twig', [
            'controller_name' => 'TournamentController',
        ]);
    }

    // PAS DE CSS, A VOIR !! 

    #[Route('/tournament/createtournoi', name: 'app_tournament_create', methods:"GET", requirements: ["id" => "\d+"])]
    public function create(): Response
    {
        return $this->render('tournament/create.html.twig', [
            // 'controller_name' => 'TournamentController',
        ]);
    }


    // je met ici le club

    #[Route('/club/createclub', name: 'app_club_create', methods:"GET", requirements: ["id" => "\d+"])]
    public function createclub(): Response
    {
        return $this->render('club/create.html.twig', [
            // 'controller_name' => 'TournamentController',
        ]);
    }
    
}
