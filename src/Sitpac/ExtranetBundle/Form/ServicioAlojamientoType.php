<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioAlojamientoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('codigoAlojamiento')
		->add('tipoAlojamiento')
		->add('precio','text')
		->add('foto', 'file', array('required' => false))
		->add('detalles', 'textarea', array('required' => false));
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioAlojamiento'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_srvicioalojamientotype';
	}
}