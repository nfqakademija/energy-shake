<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.11.1
 * Time: 18.08
 */

namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options){

        /*$listener = function (FormEvent $event){
          $data = $event->getData();
          $data->setRegDate(new \DateTime());
          $event->setData($data); //negera praktika
        };*/


        $builder
            ->add('username', TextType::class, array('label' => 'Username'))
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'button tm'
                ],
                'label' => 'Register'
            ]);
           // ->addEventListener(FormEvents::POST_SET_DATA, $listener);
    }
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => User::class
        ]);

        //$resolver->setRequired('translator');
    }
}