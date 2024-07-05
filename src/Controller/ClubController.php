<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

     // je met ici le club

     #[Route('/club/createclub', name: 'app_club_create', methods:"GET", requirements: ["id" => "\d+"])]
     public function createclub(): Response
     {
         return $this->render('club/create.html.twig', [
             // 'controller_name' => 'TournamentController',
         ]);
     }
}
