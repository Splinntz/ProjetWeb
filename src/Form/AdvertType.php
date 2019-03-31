<?php
/**
 * Created by PhpStorm.
 * User: Guillaumé
 * Date: 24/02/2019
 * Time: 14:09
 */

namespace App\Form;


use App\Entity\Advert;
use App\Entity\Discipline;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder
            ->add('text', TextareaType::class)
            ->add('price', NumberType::class)
            ->add('place', TextType::class)

            ->add('disciplines', EntityType::class, [
                'class' => Discipline::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])

            ->add('submit', SubmitType::class,['attr'=>['class'=>'btn btn-primary mx-auto']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advert::class
        ]);
    }
}