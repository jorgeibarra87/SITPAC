<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PerfilpType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('nombres')
		->add('apellidos')
		->add('empresa')
		->add('direccion')
		->add('telefono')
		->add('fax')
		->add('documentos', 'file', array(
		'data_class' => null,
		'read_only' => true,
		'required' => false))
		->add('email', 'email', array('read_only' => true))

		->add('password', 'repeated', array(
		'required' => false,
    	'type' => 'password',
    	'invalid_message' => 'Las dos contraseñas deben coincidir',
    	'first_name'      => 'Password',
    	'second_name'     => 'Repita_password'));

	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\Proveedor'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_perfilptype';
	}
}