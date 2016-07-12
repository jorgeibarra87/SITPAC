<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estado')
            ->add('fechaEmision', 'date', array(
            'input'  => 'datetime',
            'widget' => 'choice',))
            ->add('fechaCobro', 'date', array(
            'input'  => 'datetime',
            'widget' => 'choice',))
            ->add('valor')
            ->add('iva')
            ->add('total')
            ->add('reservareserva')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\Factura'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_facturatype';
    }
}
