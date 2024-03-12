<?php

namespace App\Form;

use App\Entity\RecupChild;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecupChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', Type\TextType::class,['label' => 'Nom'])
            ->add('firstName',Type\TextType::class,['label' => 'Prénom'])
            //->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecupChild::class,
        ]);
    }
}
