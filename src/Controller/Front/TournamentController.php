<?php

namespace App\Controller\Front;

use App\Entity\Game;
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

        return $this->render('tournament/index.html.twig', [
            'tournamentHome' => $tournamentHome,
        ]);
    }


    #[Route('/tournament/{id}', name: 'app_tournament_read', methods:"GET", requirements: ["id" => "\d+"])]
    public function read(Tournament $tournamentRead): Response
{ 
    // Récupérer les utilisateurs inscrits à ce tournoi avec leur club
    $clubs = $tournamentRead->getClubs();
// dd($clubs->isEmpty());
    return $this->render('tournament/read.html.twig', [
        'tournamentRead' => $tournamentRead,
        'clubs' => $clubs,
    ]);
}

    



    // route des score avec tournoi{id}

    #[Route('/tournament/{id}/score/', name: 'app_tournament_score', methods:"GET", requirements: ["id" => "\d+"])]
    public function score(Tournament $tournament, EntityManagerInterface $entityManager): Response
    {
        $games = $entityManager->getRepository(Game::class)->findBy(['tournament' => $tournament]);

        return $this->render('game/score.html.twig', [
            'tournament' => $tournament,
            'games' => $games,
        ]);
    }

    // #[Route('/tournament/{id}/register', name: 'app_tournament_register', methods:"GET", requirements: ["id" => "\d+"])]
    // public function register(Tournament $tournamentRead): Response
    // {
      
    //     return $this->render('tournament/register.html.twig', [
    //         'tournamentRead' => $tournamentRead,
    //         // 'form' => $form->createView(),
    //     ]);
   
    // }

      // route des score avec tournoi{id}

      #[Route('/tournament/{id}/games', name: 'app_tournament_games', methods:"GET", requirements: ["id" => "\d+"])]
      public function scoreAdd(Tournament $tournament, EntityManagerInterface $entityManager): Response
      {
        $games = $entityManager->getRepository(Game::class)->findBy(['tournament' => $tournament]);

        //dd($tournament);

        return $this->render('game/index.html.twig',[
            'tournament' => $tournament,
            'games' => $games,
        ]);

      }
     
// Créer un tournoi
      #[Route('/create', name: 'app_create_tournament', methods: ['GET', 'POST'])]
      public function new(Request $request, EntityManagerInterface $entityManager): Response
      {
          $tournament = new Tournament();
          $form = $this->createForm(TournamentType::class, $tournament);
          $form->handleRequest($request);
  
          if ($form->isSubmitted() && $form->isValid()) {
              $user = $this->getUser();
              $tournament->setCreator($user);
              $entityManager->persist($tournament);
              $entityManager->flush();
  
              return $this->redirectToRoute('app_tournament_browse', [], Response::HTTP_SEE_OTHER);
          }
  
          return $this->render('tournament/new.html.twig', [
              'tournament' => $tournament,
              'form' => $form,
          ]);
      }

      #[Route('/tournament/{id}/register', name: 'app_tournament_register', methods: ['GET'], requirements: ['id' => '\d+'])]
      public function showRegistrationForm(Tournament $tournament): Response
      {
          $user = $this->getUser();
          if (!$user) {
              $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
              return $this->redirectToRoute('app_login');
          }

          $isAlreadyRegistered = $user->getClub()->getTournaments()->contains($tournament);
    // dd($isAlreadyRegistered);
          return $this->render('tournament_registration/register.html.twig', [
              'tournament' => $tournament,
              'isAlreadyRegistered' => $isAlreadyRegistered,
          ]);
      }
  
      
}
