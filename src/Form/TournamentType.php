<?php

namespace App\Form;


use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    ->add('tournament_name', TextType::class, [
        'label' => "Nom du Tournoi",])
    ->add('date', null, [
        'widget' => 'single_text',
    ])
    ->add('price', IntegerType::class, [
        'label' => "Prix",])
    ->add('rewards', TextType::class, [
        'label' => "Récompenses",])
    ->add('team_count', TextType::class, [
        'label' => "Nombre d'équipes",])
    ->add('player_team_count', TextType::class, [
        'label' => "Nombre de joueurs",])
    ->add('location', TextType::class, [
        'label' => "Lieu",]) 
    ->add('poster', UrlType::class, [
        'label' => "Affiche du Tournoi",
        'help' => "Url vers l'affiche"]);
    // ->add('submit', SubmitType::class, [
    //     'label' => 'Envoyer',
    //     'attr' => ['class' => 'btn btn-secondary w-50 mx-auto'] // Attention à la syntaxe correcte ici
    // ]);
     
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
