<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 01/04/19
 * Time: 02:29
 */

namespace App\Form;


use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder
            ->add('text', TextareaType::class)
            ->add('submit', SubmitType::class,['attr'=>['class'=>'btn btn-primary mx-auto']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class
        ]);
    }
}