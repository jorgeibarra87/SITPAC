<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('tipoProducto', 'choice', array(

  		'choices' => array(
        'Alojamiento' => 'Alojamiento',
        'Alimentacion' => 'Alimentacion',
        'Excursion' => 'Excursion',
        'Transporte' => 'Transporte',
        'Vuelo' => 'Vuelo')))

        ->add('nombre')
		
		->add('foto', 'file', array(
		'data_class' => null,
		'required' => false))
		
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
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\Producto'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_productotype';
	}
}