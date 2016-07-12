<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioAlimentacionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('nombre')
		
		->add('tipo', 'choice', array(

  		'choices' => array(
  		'Almuerzo' => 'Almuerzo',
        'Desayuno' => 'Desayuno',
        'Cena' => 'Cena',
        'Otro' => 'Otro')))

		->add('foto', 'file', array('required' => false))
		->add('hora')
		->add('direccion', 'textarea')
		->add('detalles', 'textarea', array('required' => false))
		->add('precio','text' );
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioAlimentacion'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_srvicioalimentaciontype';
	}
}