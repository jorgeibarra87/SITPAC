<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioPaqVuelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('fechaVuelo', 'date', array('widget' => 'single_text', ))
            ->add('descuento');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\ServicioPaqVuel'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_serviciopaqvueltype';
    }
}
