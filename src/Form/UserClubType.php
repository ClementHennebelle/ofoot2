<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Game;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('club_name')
            ->add('hasClub', CheckboxType::class, [
                'label' => 'Cet utilisateur a-t-il un club ?',
                'required' => false,
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
