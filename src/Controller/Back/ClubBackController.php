<?php

namespace App\Controller\Back;

use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/club/back')]
class ClubBackController extends AbstractController
{
    #[Route('/', name: 'app_club_back_index', methods: ['GET'])]
    public function index(ClubRepository $clubRepository): Response
    {
        return $this->render('club_back/index.html.twig', [
            'clubs' => $clubRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_club_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('app_club_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('club_back/new.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_club_back_show', methods: ['GET'])]
    public function show(Club $club): Response
    {
        return $this->render('club_back/show.html.twig', [
            'club' => $club,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_club_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Club $club, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_club_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('club_back/edit.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_club_back_delete', methods: ['POST'])]
    public function delete(Request $request, Club $club, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$club->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($club);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_club_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
