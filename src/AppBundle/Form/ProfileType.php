<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.11.17
 * Time: 23.16
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username',
            TextType::class,
            [
                'label' => 'user.username'
            ]
        )->add(
            'name',
            TextType::class,
            [
                'label' => 'user.name',
                'required' => false

            ]
        )->add(
            'surname',
            TextType::class,
            [
                'label' => 'user.surname',
                'required' => false
            ]
        )->add(
            'email',
            EmailType::class,
            [
                'label' => 'user.email',
            ]
        )->add(
            'save',
            SubmitType::class,
            [
                'label' => 'action.save',
                'attr' => ['class' => "btn pull-right"],
            ]
        );
    }
}
