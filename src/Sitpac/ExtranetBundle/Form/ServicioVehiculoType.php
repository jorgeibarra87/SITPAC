<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioVehiculoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('tipo', 'choice', array(

  		'choices' => array(
  		'Automovil' => 'Automovil',
        'Camioneta' => 'Camioneta',
        'Buseta' => 'Buseta',
        'Bus' => 'Bus',
        'Campero' => 'Campero',
        'Ban' => 'Ban',
        'Otro' => 'Otro')))

        ->add('chofer')
        ->add('foto', 'file', array('required' => false))
        ->add('modelo','number')
        ->add('placa')
        ->add('origen')
        ->add('destino')
        ->add('precio','text')
		->add('detalles', 'textarea', array('required' => false));
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioVehiculo'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_srvicioexcursiontype';
	}
}