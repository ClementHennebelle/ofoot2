<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    // route des score avec tournoi{id}

    #[Route('/tournament/score/{id}', name: 'app_tournament_score', methods:"GET", requirements: ["id" => "\d+"])]
    public function score(Tournament $tournamentRead): Response
    {
      
        return $this->render('score/score.html.twig', [
            'tournamentRead' => $tournamentRead,
        ]);
    }

    
}
