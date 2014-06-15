<?php
// src/Acatism/MainBundle/Form/Type/ProfessorCvType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfessorCvType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		     ->add('domains', 'textarea',  array('required' => true, 'label' => 'Domains of interest'))
		     ->add('teaching', 'textarea',  array('required' => true, 'label' => 'Teaching'))
		     ->add('publications', 'textarea',  array('required' => true, 'label' => 'Publications'))
		     ->add('languages', 'textarea', array('required' => true, 'label' => 'Languages'))
		     ->add('previous', 'submit', array('label' => 'Previous page'))
		     ->add('next', 'submit', array('label' => 'Next page'));
	}

	public function getName()
	{
		return 'professorCv';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Acatism\MainBundle\Document\Professor',
			));
	}
}