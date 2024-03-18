<?php

namespace App\Form;

use App\Entity\AddCreche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AddCrecheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,
                [
                    'attr' => array('placeholder' => 'Nom'),
                    'label' => false,
                ])

            ->add('siret',TextType::class,
                [
                    'attr' => array('placeholder' => 'N° de siret'),
                    'label' => false,
                ])

            ->add('tarif',TextType::class,
                [
                    'attr' => array('placeholder' => 'Tarif horaire'),
                    'label' => false,
                ])

            ->add('adresse',TextType::class,
                [
                    'attr' => array('placeholder' => 'Adresse'),
                    'label' => false,
                ])

            ->add('email',TextType::class,
                [
                    'attr' => array('placeholder' => 'Email'),
                    'label' => false,
                ])

            ->add('telephone',TextType::class,
                [
                    'attr' => array('placeholder' => 'N° de téléphone'),
                    'label' => false,
                ])

//            ->add('agrement',TextType::class,
//                [
//                    'attr' => array('placeholder' => 'Agrement'),
//                    'label' => false,
//                ])

            ->add('status',TextType::class,
                [
                    'attr' => array('placeholder' => 'Status'),
                    'label' => false,
                ])
            ->add('brochure', FileType::class, [
                'label' => false,

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
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
