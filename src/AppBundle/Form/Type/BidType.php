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

class BidType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название',
                'attr' => [
                    'maxlength' => '100',
                    'required' => true,
                ],
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Содержание',
                'attr' => [
                    'maxlength' => '100',
                    'required' => true,
                ],
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Цена',
                'attr' => [
                    'maxlength' => '100',
                    'required' => true,
                ],
            ])
            ->add('term', IntegerType::class, [
                'label' => 'Срок',
                'attr' => [
                    'maxlength' => '100',
                    'required' => true,
                ],
            ])
            ->add('platform', ChoiceType::class, array(
                'choices' => array(
                    'Freelancehunt' => 'Freelancehunt',
                    'Fl.ru' => 'Fl.ru'
                )))
            ->add('save', SubmitType::class);
    }
}