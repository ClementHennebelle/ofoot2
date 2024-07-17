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


#[Route('/api/game', name: 'app_apiscore')]
class GameController extends AbstractController
{
 #[Route('/', name: 'app_score', methods: "GET")]
public function index(GameRepository $gameRepository) : JsonResponse
 {
$allScore = $gameRepository->findAll();
return $this->json($allScore, 200, [], ["groups" => "score_browse"]);
 }


//  // Route pour ajouter un nouveau score
//  #[Route('/post', name: 'score_post', methods: ['POST'])]
//  public function postScore(Request $request, EntityManagerInterface $entityManager): JsonResponse
//  {
//      // Décode le contenu JSON de la requête
//      $data = json_decode($request->getContent(), true);

//      // Vérifie si le score est présent dans les données reçues
//      if (!isset($data['score'])) {
//          return $this->json(['error' => 'Score is required'], 400);
//      }

//      // Crée un nouvel objet Game
//      $game = new Game();
//      $game->setScore($data['score']);
     
//      // Définit des valeurs par défaut pour les champs obligatoires
//      $game->setDate(new \DateTime()); // Date actuelle
//      $game->setTime(new \DateTime()); // Heure actuelle
//      $game->setLocation('Default Location');
//      $game->setDescription('Default Description');
//      $game->setName('Default Name'); // Ajoutez cette ligne pour définir un nom par défaut

//      // Persiste le nouvel objet Game dans la base de données
//      $entityManager->persist($game);
//      $entityManager->flush();

//      // Retourne une réponse JSON avec les détails du score ajouté
//      return $this->json([
//          'message' => 'Score added successfully',
//          'id' => $game->getId(),
//          'score' => $game->getScore()
//      ], 201); // 201 est le code de statut HTTP pour "Created"
//  }

 #[Route('/{id}', name: 'score_update', methods: ['PATCH'])]
 public function updateScore(Request $request, EntityManagerInterface $entityManager, int $id): JsonResponse
 {
    $rawData = $request->getContent();
    error_log('Raw request data: ' . $rawData);

    $data = json_decode($rawData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('JSON decode error: ' . json_last_error_msg());
        return $this->json(['error' => 'Invalid JSON data'], 400);
    }

    error_log('Decoded data: ' . print_r($data, true));

    $score = $data['score'] ?? null;
    $firstClubId = $data['firstClub'] ?? null;
    $secondClubId = $data['secondClub'] ?? null;
    $name = $data['name'] ?? null;

    if ($score === null || $firstClubId === null || $secondClubId === null || $name === null) {
        return $this->json(['error' => 'All fields are required'], 400);
    }

    $game = $entityManager->getRepository(Game::class)->find($id);
    if (!$game) {
        return $this->json(['error' => 'Game not found'], 404);
    }

    $firstClub = $entityManager->getRepository(Club::class)->find($firstClubId);
    $secondClub = $entityManager->getRepository(Club::class)->find($secondClubId);
    if (!$firstClub || !$secondClub) {
        return $this->json(['error' => 'One or both clubs not found'], 404);
    }

    $game->setScore($score);
    $game->setFirstClub($firstClub);
    $game->setSecondClub($secondClub);
    $game->setName($name);

    $entityManager->flush();

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