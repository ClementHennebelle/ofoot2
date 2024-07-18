<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ClubRepository;
use App\Entity\Club;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AddClubType;
use App\Form\ClubType;

class ClubController extends AbstractController
{

    // #[Route('/club', name: 'app_club_browse', methods:"GET")]
    // public function browse(ClubRepository $clubpRepo): Response
    // {
    //     $allClubs = $clubpRepo->findAll();
    //     return $this->render('club/browse.html.twig', [
    //         'clubList' => $allClubs,
    //     ]);
    // }

    // Route pour afficher les détails du club de l'utilisateur connecté

    #[Route('/club', name: 'app_club_read', methods: ["GET"])]
    public function read(): Response
    {
        // Vérification de la connexion de l'utilisateur
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        // Récupération du club de l'utilisateur
        $club = $user->getClub();
        if (!$club) {
            $this->addFlash('error', 'Vous n\'êtes rattaché à aucun club.');
            return $this->redirectToRoute('app_account');
        }
        // Récupération des informations du club
        $clubName = $club->getClubName();
        $clubLicenceNumber = $club->getLicenceNumber();
        $clubAdress = $club->getAdress();
        $clubDateCreation = $club->getCreatedAt() ? $club->getCreatedAt()->format('d/m/Y') : 'Date de création inconnue';
        $clubLogo = $club->getLogo();
        // Récupération des membres du club
        $members = [];
        foreach ($club->getUsers() as $member) {
            $members[] = [
                'lastname' => $member->getLastname(),
                'firstname' => $member->getFirstname(),
                'email' => $member->getEmail(),
            ];
        }

        // Récupération des tournois du club


        // Récupération des tournois futurs du club

        $tournaments = [];
        foreach ($club->getTournaments() as $tournament) {
            if ($tournament->getDate() > new \DateTime()) {
                $tournaments[] = [
                    'tournamentName' => $tournament->getTournamentName(),
                    'tournamentDate' => $tournament->getDate()->format('d/m/Y'),
                    'tournamentLocation' => $tournament->getLocation(),
                    'tournamentTeamCount' => $tournament->getTeamCount(),
                    'tournamentPlayerTeamCount' => $tournament->getPlayerTeamCount(),
                    'tournamentPrice' => $tournament->getPrice(),
                    'tournamentRewards' => $tournament->getRewards(),
                ];
            }
        }
        // Récupération des tournois auxquels l'utilisateur est inscrit
        $userTournaments = [];
        foreach ($user->getTournaments() as $tournament) {
            $userTournaments[] = [
                'tournamentName' => $tournament->getTournamentName(),
                'tournamentDate' => $tournament->getDate()->format('d/m/Y'),
            ];
       


        // Préparation des informations du club pour la vue

        $clubInfo = [
            'clubName' => $clubName,
            'clubLicenceNumber' => $clubLicenceNumber,
            'clubAdress' => $clubAdress,
            'clubDateCreation' => $clubDateCreation,
            'clubLogo' => $clubLogo,
            'members' => $members,
            'tournaments' => $tournaments,
            'userTournaments' => $userTournaments,
        ];



        // Rendu de la vue avec les informations du club

        return $this->render('club/read.html.twig', [
            'clubInfo' => $clubInfo,
            'clubId' => $club->getId(),
        ]);
    }



    // Route pour ajouter un nouveau club

    #[Route('/club/add', name: 'app_club_add', methods:["GET", "POST"])]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $club = new Club();
        $form = $this->createForm(AddClubType::class, $club);
        $form->setData($club);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($club);
            $em->flush();
            $this->addFlash('success', 'Club ajouté avec succès');
            return $this->redirectToRoute('app_club_read');
        }
        return $this->render('club/add.html.twig', [
            'form' => $form,
        ]);

        }
     #[Route('/createclub', name: 'app_club_create_club', methods: ['GET', 'POST'])]
     public function new(Request $request, EntityManagerInterface $entityManager): Response
     {
         $club = new Club();
         $form = $this->createForm(ClubType::class, $club);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->persist($club);
             $entityManager->flush();
             return $this->redirectToRoute('app_club_browse', [], Response::HTTP_SEE_OTHER);
         }
         return $this->render('club_back/new.html.twig', [
             'club' => $club,
             'form' => $form,
         ]);
     }

    }

    // Route pour créer un nouveau club (similaire à add, potentiellement redondant)
    #[Route('/createclub', name: 'app_club_create_club', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('app_club_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('club_back/new.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

}