<?php
// src/Controller/ErrorController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{
    private $debug;

    public function __construct(bool $debug)
    {
        $this->debug = $debug;
    }

    public function show(Request $request, FlattenException $exception): Response
    {
        $statusCode = $exception->getStatusCode();
        switch ($statusCode) {
            case 404:
                $statusText = 'Page non trouvée';
                break;
            case 403:
                $statusText = 'Accès interdit';
                break;
            case 500:
                $statusText = 'Erreur interne du serveur';
                break;
            default:
                $statusText = 'Une erreur est survenue';
        }

        return $this->render('error/error.html.twig', [
            'status_code' => $statusCode,
            'status_text' => $statusText,
            'exception' => $exception,
        ]);
    }

    /**
     * @Route("/test-error", name="app_test_error")
     */
    #[Route('/test-error', name: 'app_test_error')]
    public function testError(): Response
    {
        throw $this->createNotFoundException();
    }
}