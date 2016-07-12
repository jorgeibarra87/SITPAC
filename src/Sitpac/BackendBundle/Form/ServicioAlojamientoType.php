<?php

namespace Sitpac\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioAlojamientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigoAlojamiento')
            ->add('tipoAlojamiento')
            ->add('precio','integer')
            ->add('foto')
            ->add('detalles')
            ->add('fechaCreacion', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('estado')
            ->add('productoproducto')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioAlojamiento'
        ));
    }

    public function getName()
    {
        return 'sitpac_extranetbundle_servicioalojamientotype';
    }
}
