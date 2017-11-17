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
                'label' => 'label.concierge.email',
                'translation_domain' => 'user',
                'required' => false
            ]
        )->add(
            'name',
            TextType::class,
            [
                'label' => 'label.concierge.company',
                'translation_domain' => 'user',
                'required' => false

            ]
        )->add(
            'surname',
            TextType::class,
            [
                'label' => 'label.concierge.first_name',
                'translation_domain' => 'user',
                'required' => false
            ]
        )->add(
            'email',
            EmailType::class,
            [
                'label' => 'label.concierge.last_name',
                'translation_domain' => 'user'
            ]
        )->add(
            'save',
            SubmitType::class,
            [
                'label' => 'button.save',
                'translation_domain' => 'user',
                'attr' => ['class' => "btn-success btn pull-right"],
            ]
        );
    }
}