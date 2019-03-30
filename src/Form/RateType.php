<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 30/03/2019
 * Time: 17:42
 */

namespace App\Form;


use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rate', NumberType::class)

            ->add('submit', SubmitType::class,['attr'=>['class'=>'btn btn-primary mx-auto']]);
    }
}