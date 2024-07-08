<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Game;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Tournament1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tournament_name')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('price')
            ->add('rewards')
            ->add('team_count')
            ->add('player_team_count')
            ->add('location')
            ->add('poster', UrlType::class, [
                'label' => "Image",
                'help' => "Url vers l'affiche"
            ])
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('clubs', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
