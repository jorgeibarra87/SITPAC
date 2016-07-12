<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioExcursionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('nombre')
		->add('tipo')
		->add('foto', 'file', array('required' => false))
		->add('detalles', 'textarea', array('required' => false))
		->add('precio','text');
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioExcursion'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_srvicioexcursiontype';
	}
}