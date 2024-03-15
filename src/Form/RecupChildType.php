<?php

namespace App\Form;

use App\Entity\RecupChild;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecupChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName',TextType::class,
                [
                    'attr' => array('placeholder' => 'Nom'),
                    'label' => false,
                ]
            )
            ->add('firstName',TextType::class,
                [
                    'attr' => array('placeholder' => 'Prenom'),
                    'label' => false,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecupChild::class,
        ]);
    }
}
