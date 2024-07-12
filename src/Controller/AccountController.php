<?php

namespace App\Controller;

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

    // Vérifier si l'utilisateur est connecté
    if (!$user) {
        // Gérer le cas où aucun utilisateur n'est connecté
        return $this->redirectToRoute('app_login'); // Rediriger vers la page de connexion par exemple
    }

    // Si l'utilisateur est connecté, récupérer les informations du compte
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
        $clubName = $user->getClub() ? $user->getClub()->getClubName() : 'Aucun club associé';
        $clubLicenceNumber = $user->getClub() ? $user->getClub()->getLicenceNumber() : 'Aucun numéro de licence associé';
        $clubDateCreation = $user->getClub() ? $user->getClub()->getCreatedAt() : 'Aucun club associé';
        $clubLogo = $user->getClub() ? $user->getClub()->getLogo() : 'Aucun logo associé';
        $userTournament = $user->getTournament() ? $user->getTournament()->getTournamentName() : 'Inscrit pour aucun tournoi prochainement';
        $userTournamentDate = $user->getTournament() ? $user->getTournament()->getDate() : 'Pas de date pour ce tournoi';
        $accountInfo = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail(),
            'clubName' => $clubName,
            'clubLicenceNumber' => $clubLicenceNumber,
            'clubDateCreation' => $clubDateCreation,
            'clubLogo' => $clubLogo, 
            'userTournament' => $userTournament  ,
            'userTournamentDate' => $userTournamentDate
        ];

        return $this->render('account/accounthome.html.twig', [
            'controller_name' => 'AccountController',
            'accountInfo' => $accountInfo,
        ]);
    }

    #[Route('/account/addclub', name: 'app_account_addclub', methods: ['GET', 'POST'])]
    public function addClub(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Récupération de tous les clubs pour afficher dans le formulaire
        $clubs = $entityManager->getRepository(Club::class)->findAll();

        if ($request->isMethod('POST')) {
            $clubId = $request->request->get('club');

            if ($clubId) {
                $club = $entityManager->getRepository(Club::class)->find($clubId);

                if ($club) {
                    // Associer l'utilisateur au club sélectionné
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
