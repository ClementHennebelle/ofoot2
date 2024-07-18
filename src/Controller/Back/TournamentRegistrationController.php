<?php
namespace App\Controller\Back;

use App\Entity\Tournament;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class TournamentRegistrationController extends AbstractController
{
    // Route pour le processus d'inscription à un tournoi
    #[Route('/tournament/{id}/register', name: 'app_tournament_register_process', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function processRegistration(Request $request, Tournament $tournament, EntityManagerInterface $entityManager): Response
    {
        // Récupération de l'utilisateur courant
        $user = $this->getUser();

        // Vérification si l'utilisateur est connecté
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
            return $this->redirectToRoute('app_login');
        }

        // Récupération du club de l'utilisateur
        $club = $user->getClub();

        // Vérification si le club est déjà inscrit au tournoi
        $isAlreadyRegistered = $club->getTournaments()->contains($tournament);

        if (!$isAlreadyRegistered) {
            // Si non inscrit, ajouter le tournoi au club
            $club->addTournament($tournament);
            $entityManager->persist($club);
            $entityManager->flush();
        } else {
            // Si déjà inscrit, afficher un message d'information
            $this->addFlash('info', 'Vous êtes déjà inscrit à ce tournoi.');
        }

        // Redirection vers la page d'accueil du compte
        return $this->redirectToRoute('app_account_home');
    }
}