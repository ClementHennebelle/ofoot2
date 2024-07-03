<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main', methods:"GET")]
    public function home(): Response
    {
        // 1. préparation des données
        // $allClubs = $currentClub->findAll();

        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
