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
    #[Route('/tournament/{id}/register', name: 'app_tournament_register', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function register(Request $request, Tournament $tournamentRead, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour vous inscrire à un tournoi.');
            return $this->redirectToRoute('app_login');
        }

        // Assurez-vous que $user est bien une instance de votre classe User
        if (!$user instanceof User) {
            throw new \LogicException('L\'utilisateur doit être une instance de User.');
        }

        if ($request->isMethod('POST')) {
            if (!$tournamentRead->getUsers()->contains($user)) {
                $tournamentRead->addUser($user);
                $entityManager->persist($tournamentRead);
                $entityManager->flush();
                $this->addFlash('success', 'Vous êtes inscrit au tournoi avec succès !');
            } else {
                $this->addFlash('info', 'Vous êtes déjà inscrit à ce tournoi.');
            }

            return $this->redirectToRoute('app_account_home', ['id' => $tournamentRead->getId()]);
        }

        return $this->render('tournament_registration/register.html.twig', [
            'tournamentRead' => $tournamentRead,
        ]);
    }
}