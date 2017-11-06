<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('freelancehuntId', TextType::class, [
                'label' => 'freelancehuntId',
                'attr' => [
                    'maxlength' => '100',
                    'required' => true,
                ]
            ])
            ->add('freelancehuntSecret', TextType::class, [
                'label' => 'freelancehunSecret',
                'attr' => [
                    'maxlength' => '100',
                    'required' => true,
                ],
            ])
            ->add('save', SubmitType::class);
    }
}