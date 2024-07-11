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

    #[Route('/account/addclub', name: 'app_account_addclub')]
    public function addClub(): Response
    {
        return $this->render('account/addclubaccount.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
