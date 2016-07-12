<?php

namespace Sitpac\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioVehiculoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo')
            ->add('chofer')
            ->add('foto')
            ->add('modelo')
            ->add('placa')
            ->add('origen')
            ->add('destino')
            ->add('precio','integer')
            ->add('detalles')
            ->add('fechaCreacion', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('estado')
            ->add('productoproducto')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioVehiculo'
        ));
    }

    public function getName()
    {
        return 'sitpac_extranetbundle_serviciovehiculotype';
    }
}
