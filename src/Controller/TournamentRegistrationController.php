<?php
namespace App\Controller;

use App\Entity\Tournament;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class TournamentRegistrationController extends AbstractController
{
   

    #[Route('/tournament/{id}/register', name: 'app_tournament_register_process', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function processRegistration(Request $request, Tournament $tournament, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
            return $this->redirectToRoute('app_login');
        }
        $club = $user->getClub();
        $isAlreadyRegistered = $club->getTournaments()->contains($tournament);

        if (!$isAlreadyRegistered) {
            $club->addTournament($tournament);
            $entityManager->persist($club);
            $entityManager->flush();
        } else {
            $this->addFlash('info', 'Vous êtes déjà inscrit à ce tournoi.');
        }

        return $this->redirectToRoute('app_account_home');
    }
}