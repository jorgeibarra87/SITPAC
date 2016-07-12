<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SolicitudrespuestaType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('respuesta', 'textarea');		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\Solicitudes'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_solicitudrespuestatype';
	}
}