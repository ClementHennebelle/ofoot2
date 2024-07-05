<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Game;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Length;

class AddClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('club_name', TextType::class, [
                "label" => "Nom du Club",
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('licence_number', IntegerType::class, [
                "label" => "Numéro de license du club",
                'constraints' => [
                    new NotNull(),
                    new Length(min : 6)
                ]
            ])
            ->add('adress', TextType::class, [
                "label" => "Adresse du club",
                'constraints' => [
                    new NotNull()
                ]
            ]) 
            ->add('logo', UrlType::class, [
                "label" => "Image",
                'help' => "Url vers l'image"
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
