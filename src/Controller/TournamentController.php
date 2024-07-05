<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Repository\TournamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TournamentController extends AbstractController
{
    #[Route('/tournament', name: 'app_tournament_browse', methods:"GET")]
    public function browse(TournamentRepository $tournamentRepository): Response
    {

        $tournamentHome= $tournamentRepository->findAll();

        return $this->render('tournament/home.html.twig', [
            'tournamentHome' => $tournamentHome,
        ]);
    }


    #[Route('/tournament/{id}', name: 'app_tournament_read', methods:"GET", requirements: ["id" => "\d+"])]
    public function read(Tournament $tournamentRead): Response
    {
      
        return $this->render('tournament/read.html.twig', [
            'tournamentRead' => $tournamentRead,
        ]);
    }

    

    #[Route('/tournament/createtournoi', name: 'app_tournament_create', methods:"GET", requirements: ["id" => "\d+"])]
    public function create(TournamentRepository $tournamentRepository): Response
    {
        $tournamentCreate= $tournamentRepository->findAll();
        return $this->render('tournament/create.html.twig', [
            'tournamentCreate' => $tournamentCreate,
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
