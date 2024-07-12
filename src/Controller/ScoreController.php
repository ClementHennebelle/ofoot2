<?php
namespace App\Controller;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
