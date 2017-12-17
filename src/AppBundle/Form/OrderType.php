<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                [
                    'label' => 'orderform.name'
                ]
            )->add('email', EmailType::class,
                [
                    'label' => 'orderform.email'
                ]
            )->add('phone', TextType::class,
                [
                    'label' => 'orderform.phone'
                ]
            )->add('address', TextType::class,
                [
                    'label' => 'orderform.address'
                ]
            )->add('comment', TextareaType::class,
                [
                    'required' => false,
                    'label' => 'orderform.yourcomment'
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'AppBundle\Entity\Orders']);
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'eshop_shopbundle_orders';
    }
}
