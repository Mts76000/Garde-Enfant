<?php

namespace App\Form;

use App\Entity\ProTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProTimeTypeOld extends AbstractType
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
            ->add('heure_debut', ChoiceType::class, [
                'label' => 'Heure de début',
                'choices' => $this->generateHours(),
            ])
            ->add('heure_fin', ChoiceType::class, [
                'label' => 'Heure de fin',
                'choices' => $this->generateHours(),
            ]);
        ;
    }

    private function generateHours(): array
    {
        $hours = [];
        for ($i = 0; $i < 24; $i++) {
            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
            $hours["$hour:00"] = "$hour:00";
        }
        return $hours;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProTime::class,
        ]);
    }
}
