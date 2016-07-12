<?php

namespace Sitpac\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaqueteTuristicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('foto')
            ->add('preciototal','integer')
            ->add('creadocliente', 'checkbox', array('required' => false))
            ->add('creador')
            ->add('descripcion')
            ->add('detalles')
            ->add('duracion')
            ->add('fechaInicio', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('estado')
            ->add('plazas')
            ->add('reservas')
            ->add('fechaCreacion', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('fechaCierre', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('fechaExpiracion', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('observaciones')
            ->add('municipiomunicipio', 'entity', array(
        'class' => 'FrontendBundle:Municipio',
        'property' => 'nombre',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\PaqueteTuristico'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_paqueteturisticotype';
    }
}
