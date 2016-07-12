<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaqueteTuristicocType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder

		->add('nombre')
        ->add('descripcion', 'textarea', array('required' => false))
        ->add('duracion','integer')
		->add('fechaInicio', 'date', array('widget' => 'single_text', ))
        ->add('fechaCierre', 'date', array('widget' => 'single_text', ))	

		->add('municipiomunicipio', 'entity', array(
    	'class' => 'FrontendBundle:Municipio',
   		'property' => 'nombre',
		));
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\FrontendBundle\Entity\PaqueteTuristico'
		));
	}

	public function getName()
	{
		return 'sitpac_frontendbundle_paqueteturisticoctype';
	}
}