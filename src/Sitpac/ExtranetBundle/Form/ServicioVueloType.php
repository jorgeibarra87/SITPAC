<?php

namespace Sitpac\ExtranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioVueloType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('compania')
		->add('foto', 'file', array('required' => false))
		
		->add('fecha', 'date', array(
		'input'  => 'datetime',
    	'widget' => 'choice',))

		->add('origen')
		->add('horaSalida')
		->add('destino')
		->add('categoria')
        ->add('precio','text')
		->add('detalles', 'textarea', array('required' => false));
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Sitpac\ExtranetBundle\Entity\ServicioVuelo'
		));
	}

	public function getName()
	{
		return 'sitpac_extranetbundle_srviciovuelotype';
	}
}