<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/account.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/account/home', name: 'app_account')]
    public function home(): Response
    {
        return $this->render('account/accounthome.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
