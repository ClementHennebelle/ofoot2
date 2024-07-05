<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Game;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('club_name')
            ->add('licence_number')
            ->add('adress')
            ->add('logo')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('tournament', EntityType::class, [
                'class' => Tournament::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'id',
            ])
            ->add('firstclub', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'id',
            ])
            ->add('secondclub', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'id',
            ])
            ->add('winner', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
