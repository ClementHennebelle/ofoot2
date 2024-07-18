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
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $clubName = $user->getClub() ? $user->getClub()->getClubName() : 'Aucun club associé';
        $accountInfo = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail(),
            'clubName' => $clubName,
        ];

        return $this->render('account/account.html.twig', [
            'accountInfo' => $accountInfo,
        ]);
    }

    #[Route('/account/home', name: 'app_account_home')]
    public function home(): Response
{
    $user = $this->getUser();

    if (!$user) {
        return $this->redirectToRoute('app_login');
    }
    $club = $user->getClub();
    $clubName = $club ? $club->getClubName() : 'Aucun club associé';
    $clubLicenceNumber = $club ? $club->getLicenceNumber() : 'Aucun numéro de licence associé';
    $clubDateCreation = $club ? $club->getCreatedAt()->format('d/m/Y') : 'Aucun club associé';
    $clubLogo = $club ? $club->getLogo() : 'Aucun logo associé';

    // Récupération des tournois de l'utilisateur
    $userTournaments = [];
    // dd($club);
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

    // Récupération du premier tournoi de l'utilisateur (pour affichage dans le template)
//     $userTournament = $user->getTournaments()->first();
    // $userTournamentName = $userTournament ? $userTournament->getTournamentName() : null;
    // $userTournamentDate = $userTournament ? $userTournament->getDate()->format('d/m/Y') : null;

    $accountInfo = [
        'lastname' => $user->getLastname(),
        'firstname' => $user->getFirstname(),
        'email' => $user->getEmail(),
        'clubName' => $clubName,
        'clubLicenceNumber' => $clubLicenceNumber,
        'clubDateCreation' => $clubDateCreation,
        'clubLogo' => $clubLogo,
        'userTournaments' => $userTournaments,
        // 'userTournament' => $userTournamentName,
        // 'userTournamentDate' => $userTournamentDate,
    ];

    return $this->render('account/accounthome.html.twig', [
        'accountInfo' => $accountInfo,
    ]);
}

    #[Route('/account/addclub', name: 'app_account_addclub', methods: ['GET', 'POST'])]
    public function addClub(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $clubs = $entityManager->getRepository(Club::class)->findAll();

        if ($request->isMethod('POST')) {
            $clubId = $request->request->get('club');

            if ($clubId) {
                $club = $entityManager->getRepository(Club::class)->find($clubId);

                if ($club) {
                    $user->setClub($club);
                    $entityManager->flush();

                    $this->addFlash('success', 'Votre compte a été rattaché au club avec succès.');
                    return $this->redirectToRoute('app_account');
                }
            }

            $this->addFlash('error', 'Veuillez sélectionner un club valide.');
        }

        return $this->render('account/addclubaccount.html.twig', [
            'clubs' => $clubs,
        ]);
    }
}

