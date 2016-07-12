<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoeditarType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('tipoProducto', 'choice', array(

  		'choices' => array(
        'Alojamiento' => 'Alojamiento',
        'Alimentacion' => 'Alimentacion',
        'Ecodestino' => 'Ecodestino',
        'Transporte' => 'Transporte',
        'Vuelo' => 'Vuelo',
        'Otro' => 'Otro' )))

        ->add('nombre')
		->add('descripcion', 'textarea')
		->add('detalles', 'textarea', array('required' => false))

		->add('categoria', 'choice', array(

  		'choices' => array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5' )));
		
	}
	
	

	public function getName()
	{
		return 'sitpac_extranetbundle_productotype';
	}
}