<?php

namespace App\Controller\Front;

use App\Entity\Club;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    // Route pour afficher la page de compte de l'utilisateur
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        $user = $this->getUser();

        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Préparation des informations du compte
        $clubName = $user->getClub() ? $user->getClub()->getClubName() : 'Aucun club associé';
        $accountInfo = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail(),
            'clubName' => $clubName,
        ];

        // Rendu de la vue avec les informations du compte
        return $this->render('account/account.html.twig', [
            'accountInfo' => $accountInfo,
        ]);
    }

    // Route pour afficher la page d'accueil du compte
    #[Route('/account/home', name: 'app_account_home')]
    public function home(): Response
    {
        $user = $this->getUser();

        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $club = $user->getClub();

        // Préparation des informations du club
        $clubName = $club ? $club->getClubName() : 'Aucun club associé';
        $clubLicenceNumber = $club ? $club->getLicenceNumber() : 'Aucun numéro de licence associé';
        $clubDateCreation = $club ? $club->getCreatedAt()->format('d/m/Y') : 'Aucun club associé';
        $clubLogo = $club ? $club->getLogo() : 'Aucun logo associé';

        // Récupération des tournois de l'utilisateur
        $userTournaments = [];
        foreach ($club->getTournaments() as $tournament) {
            $userTournaments[] = [
                'tournamentName' => $tournament->getTournamentName(),
                'tournamentDate' => $tournament->getDate()->format('d/m/Y'),
                'tournamentLocation' => $tournament->getLocation(),
                'tournamentTeamCount' => $tournament->getTeamCount(),
                'tournamentPlayerTeamCount' => $tournament->getPlayerTeamCount(),
                'tournamentPrice' => $tournament->getPrice(),
                'tournamentRewards' => $tournament->getRewards(),
            ];
        }

        // Préparation des informations du compte
        $accountInfo = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail(),
            'clubName' => $clubName,
            'clubLicenceNumber' => $clubLicenceNumber,
            'clubDateCreation' => $clubDateCreation,
            'clubLogo' => $clubLogo,
            'userTournaments' => $userTournaments,
        ];

        // Rendu de la vue avec les informations du compte
        return $this->render('account/accounthome.html.twig', [
            'accountInfo' => $accountInfo,
        ]);
    }

    // Route pour ajouter un club à un compte utilisateur
    #[Route('/account/addclub', name: 'app_account_addclub', methods: ['GET', 'POST'])]
    public function addClub(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Récupération de tous les clubs
        $clubs = $entityManager->getRepository(Club::class)->findAll();

        // Traitement du formulaire de sélection de club
        if ($request->isMethod('POST')) {
            $clubId = $request->request->get('club');

            if ($clubId) {
                $club = $entityManager->getRepository(Club::class)->find($clubId);

                if ($club) {
                    // Association du club à l'utilisateur
                    $user->setClub($club);
                    $entityManager->flush();

                    $this->addFlash('success', 'Votre compte a été rattaché au club avec succès.');
                    return $this->redirectToRoute('app_account');
                }
            }

            $this->addFlash('error', 'Veuillez sélectionner un club valide.');
        }

        // Rendu de la vue pour ajouter un club
        return $this->render('account/addclubaccount.html.twig', [
            'clubs' => $clubs,
        ]);
    }
}