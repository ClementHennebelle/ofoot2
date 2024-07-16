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
use App\Form\ClubType;

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



    