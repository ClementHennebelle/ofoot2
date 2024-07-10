<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ClubRepository;
use App\Entity\Club;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AddClubType;



class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club_browse', methods:"GET")]
    public function browse(ClubRepository $clubpRepo): Response
    {

        $allClubs = $clubpRepo->findAll();

        return $this->render('club/browse.html.twig', [
            'clubList' => $allClubs,
        ]);
    }


     #[Route('/club/{id}', name: 'app_club_read', methods:"GET", requirements: ["id" => "\d+"])]
     public function read(Club $club): Response
     {
         return $this->render('club/read.html.twig', [
            'club' => $club,
         ]);
     }


     #[Route('/club/add', name: 'app_club_add', methods:["GET", "POST"], requirements: ["id" => "\d+"])]
     public function add(EntityManagerInterface $em, Request $request): Response
     {

        $club= new Club();

        $form = $this->createForm(AddClubType::class, $club);
        $form->setData($club);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($club);

            $em->flush();

            $this->addFlash('success', 'Club ajouté avec succès');

            return $this->redirectToRoute('app_club_read', ["id" => $club->getId()] );
        }

        return $this->render('club/add.html.twig', [
            'form' => $form,
        ]);

         
     }


    //  #[Route('/rattachement/user', name: 'register_user_club')]
    // public function registerUserClub(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     $user = new User();
    //     $form = $this->createForm(UserClubType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Hasher le mot de passe
    //         $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
    //         $user->setPassword($hashedPassword);

    //         if (!$user->getHasClub()) {
    //             $user->setClub(null);
    //         }

    //         $entityManager->persist($user);
    //         $entityManager->flush();

    //         $this->addFlash('success', 'L\'utilisateur a été enregistré avec succès !');
    //         return $this->redirectToRoute('some_route');
    //     }

    //     return $this->render('user_club/register.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
}



    