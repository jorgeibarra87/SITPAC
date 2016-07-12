<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IntinerarioReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreProducto')
            ->add('nombreServicio')
            ->add('detalles')
            ->add('duracion')
            ->add('fechaInicio')
            ->add('fechaFin')
            ->add('descuento')
            ->add('precioServicio')
            ->add('idReserva')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\IntinerarioReserva'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_intinerarioreservatype';
    }
}
