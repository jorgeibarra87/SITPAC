<?php

namespace Sitpac\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PerfilType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('nombres')
		->add('apellidos')
		->add('direccion')
		->add('telefono')
		->add('nacionalidad')
		->add('empresa')
		->add('email', 'email', array('read_only' => true))

		->add('password', 'repeated', array(
		'required' => false,
    	'type' => 'password',
    	'invalid_message' => 'Las dos contraseñas deben coincidir',
    	'first_name'      => 'Password',
    	'second_name'     => 'Repita_password'))

		->add('permiteEmail', 'checkbox', array('required' => false));

	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\FrontendBundle\Entity\Cliente'
		));
	}

	public function getName()
	{
		return 'sitpac_frontendbundle_perfiltype';
	}
}