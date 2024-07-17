<?php
namespace App\Form;
use App\Entity\Club;
use App\Entity\Game;
use App\Entity\Tournament;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Récupère le tournoi passé en option lors de la création du formulaire
    $tournament = $options['tournament'];

    $builder

        //  Ajoute un champ pour le score du match
        // ->add('score', TextType::class, [
        //     'label' => 'Score du match',
        //     'required' => false,
        // ])
        // Ajoute un champ pour le nom du match
        ->add('name')
    
      
        // Ajoute un champ pour le tournoi, qui sera désactivé et pré-rempli
        ->add('tournament', EntityType::class, [
            'class' => Tournament::class,
            'choice_label' => 'tournamentName', // Utilise la méthode getTournamentName() pour afficher le nom
            'data' => $tournament, // Pré-remplit avec le tournoi passé en option
            'disabled' => true, // Désactive le champ pour empêcher sa modification
        ]);


    // Ajoute un écouteur d'événement qui se déclenche juste avant que les données ne soient définies sur le formulaire
    $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($tournament) {


        $form = $event->getForm();


        // Récupère les clubs associés au tournoi
        $clubChoices = $tournament->getClubs();


        // Ajoute dynamiquement les champs pour les clubs participants
        $form->add('firstClub', EntityType::class, [
            'class' => Club::class,
            'choice_label' => 'clubName', // Utilise la méthode getClubName() pour afficher le nom du club
            'choices' => $clubChoices, // Limite les choix aux clubs du tournoi
        ])
       
        ->add('secondClub', EntityType::class, [
            'class' => Club::class,
            'choice_label' => 'clubName',
            'choices' => $clubChoices,
        ]);
    });
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'tournament' => null, // Ajoute l'option 'tournament' avec une valeur par défaut null
        ]);
         // Définit les types autorisés pour l'option 'tournament'
         $resolver->setAllowedTypes('tournament', ['null', Tournament::class]);
    }
}