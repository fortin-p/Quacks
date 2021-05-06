<?php

namespace App\Form;

use App\Entity\Ducks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DuckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])
            ->add('duckname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])
            ->add('password', TextType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])

            ->add('ProfilImage', TextType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ducks::class,
        ]);
    }
}
