<?php
// src/Acatism/MainBundle/Form/Type/StudentAboutType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentAboutType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		     ->add('university', 'text',  array('required' => true))
		     ->add('faculty', 'text',  array('required' => true))
		     ->add('year_of_study', 'choice',  array(
		     	'required' => true,
		     	'choices' => array('1' => '1', '2' => '2', '3' => '3'),
		     	'multiple' => false,
		     	'expanded' => false))
		     ->add('group', 'text',  array('required' => true))
		     ->add('phone', 'number', array('required' => true))
		     ->add('website', 'url', array('required' => true))
		     ->add('next', 'submit');
	}

	public function getName()
	{
		return 'studentAbout';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Acatism\MainBundle\Document\Student',
			));
	}
}