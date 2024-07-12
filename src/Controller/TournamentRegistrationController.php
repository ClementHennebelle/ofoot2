<?php
namespace App\Controller;

use App\Entity\Tournament;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class TournamentRegistrationController extends AbstractController
{
    #[Route('/tournament/{id}/register', name: 'app_tournament_register', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function showRegistrationForm(Tournament $tournamentRead): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
            return $this->redirectToRoute('app_login');
        }

        $isAlreadyRegistered = ($user->getTournament() === $tournamentRead);

        return $this->render('tournament_registration/register.html.twig', [
            'tournamentRead' => $tournamentRead,
            'isAlreadyRegistered' => $isAlreadyRegistered,
        ]);
    }

    #[Route('/tournament/{id}/register', name: 'app_tournament_register_process', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function processRegistration(Request $request, Tournament $tournamentRead, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
            return $this->redirectToRoute('app_login');
        }

        $isAlreadyRegistered = ($user->getTournament() === $tournamentRead);

        if (!$isAlreadyRegistered) {
            // Désinscription de l'ancien tournoi si nécessaire
            if ($user->getTournament()) {
                $oldTournament = $user->getTournament();
                $oldTournament->removeUser($user);
                $entityManager->persist($oldTournament);
            }

            $user->setTournament($tournamentRead);
            $tournamentRead->addUser($user);
            $entityManager->persist($user);
            $entityManager->persist($tournamentRead);
            $entityManager->flush();

            $this->addFlash('success', 'Vous êtes inscrit au tournoi avec succès !');
        } else {
            $this->addFlash('info', 'Vous êtes déjà inscrit à ce tournoi.');
        }

        return $this->redirectToRoute('app_tournament_read', ['id' => $tournamentRead->getId()]);
    }
}