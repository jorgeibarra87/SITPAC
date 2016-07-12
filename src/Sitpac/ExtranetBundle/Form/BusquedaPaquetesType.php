<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BusquedaPaquetesType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder

		->add('municipiomunicipio', 'entity', array(
    	'class' => 'FrontendBundle:Municipio',
   		'property' => 'nombre'))

		->add('rangoPrecios', 'choice', array('mapped' => false,
  		'choices' => array(
        1 => '$50.000 - $100.000',
        2 => '$100.000 - $500.000',
        3 => '$500.000 - $1.000.000',
        4 => '$1.000.000 - $1.500.000',
        5 => '$1.500.000 - $2.000.000',
        6 => '$2.000.000 - $3.000.000',
        7 => '$3.000.000 - $5.000.000'
        )));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\FrontendBundle\Entity\PaqueteTuristico'
		));
	}

	public function getName()
	{
		return 'sitpac_frontendbundle_busquedapaquetestype';
	}
}