<?php
namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/score', name: 'app_apiscore')]
class ScoreController extends AbstractController
{
 #[Route('/', name: 'app_score', methods: "GET")]
public function index(GameRepository $gameRepository) : JsonResponse
 {
$allScore = $gameRepository->findAll();
return $this->json($allScore, 200, [], ["groups" => "score_browse"]);
 }


 // Route pour ajouter un nouveau score
 #[Route('/post', name: 'score_post', methods: ['POST'])]
 public function postScore(Request $request, EntityManagerInterface $entityManager): JsonResponse
 {
     // Décode le contenu JSON de la requête
     $data = json_decode($request->getContent(), true);

     // Vérifie si le score est présent dans les données reçues
     if (!isset($data['score'])) {
         return $this->json(['error' => 'Score is required'], 400);
     }

     // Crée un nouvel objet Game
     $game = new Game();
     $game->setScore($data['score']);
     
     // Définit des valeurs par défaut pour les champs obligatoires
     $game->setDate(new \DateTime()); // Date actuelle
     $game->setTime(new \DateTime()); // Heure actuelle
     $game->setLocation('Default Location');
     $game->setDescription('Default Description');

     // Persiste le nouvel objet Game dans la base de données
     $entityManager->persist($game);
     $entityManager->flush();

     // Retourne une réponse JSON avec les détails du score ajouté
     return $this->json([
         'message' => 'Score added successfully',
         'id' => $game->getId(),
         'score' => $game->getScore()
     ], 201); // 201 est le code de statut HTTP pour "Created"
 }

 #[Route('/update/{id}', name: 'score_update', methods: ['PATCH'])]
 public function updateScore(Request $request, EntityManagerInterface $entityManager, int $id): JsonResponse
 {
    
    $data = json_decode($request->getContent(), true);
    $score = $data['score'] ?? null;

    if ($score === null) {
        return $this->json(['error' => 'Score is required'], 400);
    }

    $game = $entityManager->getRepository(Game::class)->find($id);

    if (!$game) {
        return $this->json(['error' => 'Game not found'], 404);
    }

    $game->setScore($score);
    $entityManager->flush();

    return $this->json([
        'message' => 'Score updated successfully',
        'id' => $id,
        'score' => $score
    ]);
}
}