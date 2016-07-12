<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioPaqAlimType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('duracion','integer')
            ->add('fechaInicio', 'date', array('widget' => 'single_text', ))
            ->add('fechaFin', 'date', array('widget' => 'single_text', ))
            ->add('descuento');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\ServicioPaqAlim'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_serviciopaqalimtype';
    }
}
