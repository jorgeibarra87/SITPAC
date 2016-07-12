<?php

namespace Sitpac\FrontendBundle\Form;

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
            ->add('preciototal')
            ->add('creadocliente')
            ->add('creador')
            ->add('descripcion')
            ->add('detalles')
            ->add('estado')
            ->add('plazas')
            ->add('reservas')
            ->add('fechaCreacion')
            ->add('duracion')
            ->add('fechaInicio')
            ->add('fechaCierre')
            ->add('observaciones')
            ->add('municipiomunicipio')
        ;
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
