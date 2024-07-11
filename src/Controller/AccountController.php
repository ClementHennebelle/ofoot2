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
        $user = $this->getUser();
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
        $accountInfo = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail(),
            'clubName' => $clubName,
            'clubLicenceNumber' => $clubLicenceNumber,
            'clubDateCreation' => $clubDateCreation,
            'clubLogo' => $clubLogo,   
        ];
        return $this->render('account/accounthome.html.twig', [
            'controller_name' => 'AccountController',
            'accountInfo' => $accountInfo
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
