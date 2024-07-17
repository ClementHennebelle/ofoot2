<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Entity\Game;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    #[Route('/tournament/{id}/new-game', name: 'app_game_new')]
    public function newGame(Request $request, EntityManagerInterface $entityManager, Tournament $tournament): Response
    {
        $game = new Game();
        $game->setTournament($tournament);

        $form = $this->createForm(GameType::class, $game, [
            'tournament' => $tournament,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($game);
            $entityManager->flush();

            $this->addFlash('success', 'Le match a été créé avec succès.');
            return $this->redirectToRoute('app_tournament_browse', ['id' => $tournament->getId()]);
        }

        return $this->render('game/index.html.twig', [
            'form' => $form->createView(),
            'tournament' => $tournament,
        ]);
    }
}