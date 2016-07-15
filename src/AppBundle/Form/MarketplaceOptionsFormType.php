<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketplaceOptionsFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description', TextareaType::class, array('required' => false, 'attr'=> array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Product Description')));
        $builder->add('keywords', TextareaType::class, array('required' => false, 'attr'=> array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'None')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MarketplaceOptions',
        ));
    }

    public function getName() {
        return 'marketplace_options_form';
    }

}