<?php

namespace AppBundle\Form;

use AppBundle\Entity\Categories;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddProductFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('allow_sales', ChoiceType::class, array('choices' => array('Allow Sales' => 1, 'Sales Not Allowed' => 0), 'attr'=> array('class' => 'form-control')));
        $builder->add('marketplaceShow', ChoiceType::class, array('choices' => array('Show In Marketplace' => 1, 'Not Shown In Marketplace' => 0), 'attr'=> array('class' => 'form-control')));
        $builder->add('name', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Product Name')));
        $builder->add('currency', ChoiceType::class, array('choices' => array('U.S. Dollar' => 1), 'attr'=> array('class' => 'form-control')));
        $builder->add('price', NumberType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => '0.00')));
        $builder->add('commission', NumberType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Ex. 10.0')));
        $builder->add('supportEmail', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Support Email')));
        $builder->add('supportURL', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Ex. http://domain.com/example')));
        $builder->add('pageURL', TextType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => 'Ex. http://domain.com/example')));
        $builder->add('returnPeriodNumber', NumberType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => '1')));
        $builder->add('returnPeriodUnit', ChoiceType::class, array('choices' => array('Days' => 1, 'Weeks' => 2, 'Months' => 3), 'attr'=> array('class' => 'form-control')));
        $builder->add('affiliateApproval', ChoiceType::class, array('choices' => array('Manual Approval' => 0, 'Automatic Approval' => 1), 'attr'=> array('class' => 'form-control')));
        $builder->add('quantity', NumberType::class, array('attr'=> array('class' => 'form-control', 'placeholder' => '0')));
        $builder->add('description', TextareaType::class, array('required' => false, 'attr'=> array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Product Description')));
        $builder->add('keywords', TextareaType::class, array('required' => false, 'attr'=> array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'None')));
        $builder->add('category', EntityType::class, array(
            'class' => 'AppBundle:Categories',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u');
            },
            'choice_label' => 'name',
            'attr'=> array('class' => 'form-control')));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product',
        ));
    }
    
    public function getName() {
        return 'add_product_form';
    }

}