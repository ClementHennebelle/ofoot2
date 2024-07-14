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
    #[Route('/tournament/{id}/register', name: 'app_tournament_register', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function showRegistrationForm(Tournament $tournamentRead): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur est déjà inscrit à ce tournoi
        $isAlreadyRegistered = $user->getTournament() && $user->getTournament()->getId() === $tournamentRead->getId();

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

        // Vérifier si l'utilisateur est déjà inscrit à ce tournoi
        $isAlreadyRegistered = $user->getTournament() && $user->getTournament()->getId() === $tournamentRead->getId();

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
           
        }

        return $this->redirectToRoute('app_account_home', ['id' => $tournamentRead->getId()]);
    }
}
