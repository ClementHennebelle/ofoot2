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
    
            return $this->render('main/home.html.twig', [
                'tournaments' => $tournaments,
            ]);
        }

        // pour la page faq, je l'ai mis sur le main en attendant de voir si on le mettra dans un autre controlleur
        #[Route('/faq', name: 'app_main_faq', methods:"GET")]
        public function faq(): Response
        
            // 1. préparation des données
            {
                // $tournaments = $tournamentRepository->findLastThree();
        
                return $this->render('main/faq.html.twig', [
                    // 'tournaments' => $tournaments,
                ]);
            } 

            // PAREIL POUR LE ABOUT

            #[Route('/about', name: 'app_main_about', methods:"GET")]
            public function about(): Response
            
                // 1. préparation des données
                {
                    // $tournaments = $tournamentRepository->findLastThree();
            
                    return $this->render('main/about.html.twig', [
                        // 'tournaments' => $tournaments,
                    ]);
                } 

                #[Route('/cgu', name: 'app_main_cgu', methods:"GET")]
                public function cgu(): Response
                
                    // 1. préparation des données
                    {
                
                        return $this->render('main/cgu.html.twig', [
                            // 'tournaments' => $tournaments,
                        ]);
                    } 


                // pour la page de login, faudra mettre sur un controller user, pour l'instant je le met ici

                #[Route('/subscribe', name: 'app_main_subscribe', methods:"GET")]
                public function subscribe(): Response
                
                    // 1. préparation des données
                    {
                        // $tournaments = $tournamentRepository->findLastThree();
                
                        return $this->render('login/subscribe.html.twig', [
                            // 'tournaments' => $tournaments,
                        ]);
                    } 
    
                   
                   
                    #[Route('/login', name: 'app_main_login', methods:"GET")]
                    public function login(): Response
                    
                        // 1. préparation des données
                        {
                            // $tournaments = $tournamentRepository->findLastThree();
                    
                            return $this->render('login/login.html.twig', [
                                // 'tournaments' => $tournaments,
                            ]);
                        } 
}
