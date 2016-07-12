<?php

namespace Sitpac\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioVueloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('compania')
            ->add('foto')
            ->add('fecha', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('origen')
            ->add('horaSalida')
            ->add('destino')
            ->add('categoria')
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
            'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioVuelo'
        ));
    }

    public function getName()
    {
        return 'sitpac_extranetbundle_serviciovuelotype';
    }
}
