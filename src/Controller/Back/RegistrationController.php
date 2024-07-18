<?php
namespace App\Controller\Back;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    // Injection de dépendance pour le service EmailVerifier
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    // Route pour l'inscription des utilisateurs
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Persistance de l'utilisateur en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Envoi d'un email de confirmation
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('ofoot.contact@gmail.com', 'ofoot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // Connexion automatique de l'utilisateur après l'inscription
            return $security->login($user, 'form_login', 'main');
        }

        // Affichage du formulaire d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    // Route pour la vérification de l'email
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        // Vérification que l'utilisateur est complètement authentifié
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Validation du lien de confirmation d'email
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            // En cas d'erreur, ajout d'un message flash et redirection
            $this->addFlash('verify_email_error', $exception->getReason());
            return $this->redirectToRoute('app_register');
        }

        // Redirection après confirmation réussie
        return $this->redirectToRoute('app_register');
    }
}