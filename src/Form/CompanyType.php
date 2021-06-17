<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 100],
            ])
            ->add('siret', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 14],
            ])
            ->add('siren', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 9],
            ])
            ->add('naf', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 50],
            ])
            ->add('address', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 100],
            ])
            ->add('createdAt', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
