<?php

namespace App\Controller\Front;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $data = $form->getData();
                $name = $data['name'];
                $adress = $data['email'];
                $content = $data['content'];

                $from = sprintf('%s <%s>', $name, $adress);

                
                $email = (new Email())
                    ->from($from)
                    ->to('ofoot.contact@gmail.com')
                    ->subject('Demande de contact')
                    ->text($content);

                    $mailer -> send($email);
               
            // redirection meme page pour vider le formulaire
            return $this->redirectToRoute('app_main');
            
            }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form->createView(),
        ]);
    }
}
