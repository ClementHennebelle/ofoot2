<?php

namespace App\Controller;

use App\Repository\TournamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main', methods:"GET")]
    public function home(TournamentRepository $tournamentRepository): Response
    
        // 1. préparation des données
        {
            $tournaments = $tournamentRepository->findLastThree();
    
            return $this->render('home/index.html.twig', [
                'tournaments' => $tournaments,
            ]);
        }

       
    
}
