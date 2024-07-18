<?php
namespace App\Controller\API;

use App\Entity\Club;
use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

// Définition du contrôleur pour l'API des jeux
#[Route('/api/game', name: 'app_apiscore')]
class GameController extends AbstractController
{
    // Route pour récupérer tous les scores
    #[Route('/', name: 'app_score', methods: "GET")]
    public function index(GameRepository $gameRepository) : JsonResponse
    {
        // Récupère tous les jeux
        $allScore = $gameRepository->findAll();
        // Renvoie les données en JSON avec le groupe de sérialisation "score_browse"
        return $this->json($allScore, 200, [], ["groups" => "score_browse"]);
    }

    // Route pour mettre à jour un score spécifique
    #[Route('/{id}', name: 'score_update', methods: ['PATCH'])]
    public function updateScore(Request $request, EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Récupère les données brutes de la requête
        $rawData = $request->getContent();
        error_log('Raw request data: ' . $rawData);

        // Décode les données JSON
        $data = json_decode($rawData, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('JSON decode error: ' . json_last_error_msg());
            return $this->json(['error' => 'Invalid JSON data'], 400);
        }
        error_log('Decoded data: ' . print_r($data, true));

        // Extrait les données nécessaires
        $score = $data['score'] ?? null;
        $firstClubId = $data['firstClub'] ?? null;
        $secondClubId = $data['secondClub'] ?? null;
        $name = $data['name'] ?? null;

        // Vérifie si toutes les données requises sont présentes
        if ($score === null || $firstClubId === null || $secondClubId === null || $name === null) {
            return $this->json(['error' => 'All fields are required'], 400);
        }

        // Récupère le jeu à mettre à jour
        $game = $entityManager->getRepository(Game::class)->find($id);
        if (!$game) {
            return $this->json(['error' => 'Game not found'], 404);
        }

        // Récupère les clubs impliqués
        $firstClub = $entityManager->getRepository(Club::class)->find($firstClubId);
        $secondClub = $entityManager->getRepository(Club::class)->find($secondClubId);
        if (!$firstClub || !$secondClub) {
            return $this->json(['error' => 'One or both clubs not found'], 404);
        }

        // Met à jour les données du jeu
        $game->setScore($score);
        $game->setFirstClub($firstClub);
        $game->setSecondClub($secondClub);
        $game->setName($name);

        // Persiste les changements en base de données
        $entityManager->flush();

        // Renvoie une réponse JSON avec les données mises à jour
        return $this->json([
            'message' => 'Score updated successfully',
            'id' => $id,
            'name' => $name,
            'score' => $score,
            'firstClub' => $firstClub->getClubName(),
            'secondClub' => $secondClub->getClubName()
        ]);
    }
}