<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

    #[Route('/tournament/{id}/register', name: 'app_tournament_register', methods:"GET", requirements: ["id" => "\d+"])]
    public function register(Tournament $tournamentRead): Response
    {
      
        return $this->render('tournament/register.html.twig', [
            'tournamentRead' => $tournamentRead,
            // 'form' => $form->createView(),
        ]);
   
    }

      // route des score avec tournoi{id}

      #[Route('/tournament/score/{id}/add', name: 'app_tournament_add', methods:"GET", requirements: ["id" => "\d+"])]
      public function scoreAdd(): Response
      {
          return $this->render('score/add.html.twig');
          

      }
      #[Route('/tournament/score/{id}/update', name: 'app_tournament_update', methods:"GET", requirements: ["id" => "\d+"])]
      public function scoreUpdate(): Response
      {
          return $this->render('score/update.html.twig');
          

      }

}
