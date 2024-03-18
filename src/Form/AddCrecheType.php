<?php

namespace App\Form;

use App\Entity\AddCreche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCrecheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_user')
            ->add('nom')
            ->add('siret')
            ->add('description')
            ->add('tarif')
            ->add('adresse')
            ->add('email')
            ->add('telephone')
            ->add('agrement')
            ->add('status')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('modified_at', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddCreche::class,
        ]);
    }
}
