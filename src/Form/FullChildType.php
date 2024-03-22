<?php

namespace App\Form;

use App\Entity\FullChild;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FullChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => ['placeholder' => 'Nom'],
            'label' => false
        ])
        ->add('prenom', TextType::class, [
            'attr' => ['placeholder' => 'Prénom'],
            'label' => false
        ])
        ->add('age', ChoiceType::class, [
            'label' => false,
            'choices' => [
                '3 mois' => '3 mois',
                '4 mois' => '4 mois',
                '5 mois' => '5 mois',
                '6 mois' => '6 mois',
                '7 mois' => '7 mois',
                '8 mois' => '8 mois',
                '9 mois' => '9 mois',
                '10 mois' => '10 mois',
                '11 mois' => '11 mois',
                '1 ans' => '1 ans',
                '2 ans' => '2 ans',
                '3 ans' => '3 ans',
                '4 ans' => '4 ans',
                '5 ans' => '5 ans',
                '6 ans' => '6 ans',
                '7 ans' => '7 ans',
                '8 ans' => '8 ans',
            ],
            'placeholder' => 'Age',
        ])
        ->add('genre', ChoiceType::class, [
            'label' => false,
            'choices' => [
                'Masculin' => 'Masculin',
                'Féminin' => 'Féminin',
            ],
            'placeholder' => 'Choisissez un genre',
        ])
        ->add('consigne_alimentaire', TextareaType::class, [
            'attr' => ['placeholder' => 'Consigne alimentaire'],
            'label' => false
        ])
        ->add('traitement', TextareaType::class, [
            'attr' => ['placeholder' => 'Traitement'],
            'label' => false
        ])
        ->add('vaccin', ChoiceType::class, [
            'label' => false,
            'choices' => [
                'Oui' => '1',
                'Non' => '0',
            ],
            'placeholder' => 'Vaccin a jour ? ',
        ])
        ->add('alergie', TextareaType::class, [
            'attr' => ['placeholder' => 'Allergie'],
            'label' => false
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FullChild::class,
        ]);
    }
}
