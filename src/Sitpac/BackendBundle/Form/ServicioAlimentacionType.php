<?php

namespace Sitpac\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioAlimentacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('tipo')
            ->add('foto')
            ->add('hora')
            ->add('direccion')
            ->add('detalles')
            ->add('precio','integer')
            ->add('fechaCreacion', 'date', array('input'  => 'datetime','widget' => 'choice',))
            ->add('estado')
            ->add('productoproducto')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioAlimentacion'
        ));
    }

    public function getName()
    {
        return 'sitpac_extranetbundle_servicioalimentaciontype';
    }
}
