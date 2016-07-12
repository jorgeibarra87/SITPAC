<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PqrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', 'choice', array(
            'choices' => array(
            'Peticion' => 'Petición',
            'Queja' => 'Queja',
            'Reclamo' => 'Reclamo',
             )))
            ->add('descripcion');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\Pqr'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_pqrtype';
    }
}
