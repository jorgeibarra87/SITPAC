<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExcursionDisponibleType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('desde', 'date', array('widget' => 'single_text', ))
		->add('hasta', 'date', array('widget' => 'single_text', ))

		
		->add('estado', 'choice', array(

  		'choices' => array(
  		'no disponible' => 'no disponible',
  		)));
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\DisponibilidadExcu'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_disponibilidadexcutype';
	}
}