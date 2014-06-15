<?php
// src/Acatism/MainBundle/Form/Type/StudentCvType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentCvType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		     ->add('domains', 'textarea',  array('required' => true))
		     ->add('prog_languages', 'textarea',  array('required' => true))
		     ->add('prog_technologies', 'textarea',  array('required' => true))
		     ->add('projects', 'textarea',  array('required' => true))
		     ->add('languages', 'textarea', array('required' => true))
		     ->add('previous', 'submit', array('label' => 'Previous page'))
		     ->add('next', 'submit', array('label' => 'Next page'));
	}

	public function getName()
	{
		return 'studentCv';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Acatism\MainBundle\Document\Student',
			));
	}
}