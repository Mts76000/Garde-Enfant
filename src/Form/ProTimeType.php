<?php

namespace App\Form;

use App\Entity\ProTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jour', ChoiceType::class, [
                'label' => 'Jour de la semaine',
                'choices' => [
                    'Lundi'     => 'Lundi',
                    'Mardi'     => 'Mardi',
                    'Mercredi'  => 'Mercredi',
                    'Jeudi'     => 'Jeudi',
                    'Vendredi'  => 'Vendredi',
                    'Samedi'    => 'Samedi',
                    'Dimanche'  => 'Dimanche',
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('heure_debut', null, [
                'widget' => 'single_text',
                'label' => 'Heure de début'
            ])
             ->add('heure_fin', null, [
                'widget' => 'single_text',
                'label' => 'Heure de fin'
            ]);
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProTime::class,
        ]);
    }
}
