<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'maxlength' => 100,
                    'placeholder' => "Space X"
                ],
            ])
            ->add('address', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 100,
                    'placeholder' => "1 Rue Nüwa 00001 Mars"
                ],
            ])
            ->add('contact', TextType::class, [
                'required' => false,
                'attr' => ['maxlength' => 100,
                    'placeholder' => "Elon Musk"
                ],
            ])
            ->add('tva', TextType::class, [
                'required' => false,
                'attr' => ['maxlength' => 50,
                    'placeholder' => "xxxxxxxxxxxxxxxx"
                ],
            ])
            ->add('ape', TextType::class, [
                'required' => false,
                'attr' => ['maxlength' => 5,
                    'placeholder' => "xxxxx"
                ],
            ])
            ->add('siret', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 9,
                    'placeholder' => "xxxxxxxxx"
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => ['maxlength' => 100,
                    'placeholder' => "elon.musk@spacex.com"
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => ['maxlength' => 50,
                    'placeholder' => "0600000000"
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
