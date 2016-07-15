<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'First Name')));
        $builder->add('lastName', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Last Name')));
        $builder->add('address', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Address')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'sale_form_type';
    }
}
