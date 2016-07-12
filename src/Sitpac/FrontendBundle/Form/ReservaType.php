<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('origen')
            ->add('adultos','integer')
            ->add('ninos','integer');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sitpac\FrontendBundle\Entity\Reserva'
        ));
    }

    public function getName()
    {
        return 'sitpac_frontendbundle_reservatype';
    }
}
