<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.12.2
 * Time: 12.42
 */

namespace AppBundle\Form;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CartType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'quantity',
            IntegerType::class,
            [
                'label' => 'product.quantity'
            ]
        )->add(
            'save',
            SubmitType::class,
            [
                'label' => 'action.save',
                'attr' => ['class' => "btn-success btn pull-right"],
            ]
        );
    }
}
