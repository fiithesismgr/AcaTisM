<?php
// src/Acatism/MainBundle/Form/Type/ProfessorAboutType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfessorAboutType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		     ->add('university', 'text',  array('required' => true))
		     ->add('faculty', 'text',  array('required' => true))
		     ->add('title', 'text',  array('required' => true))
		     ->add('office', 'text',  array('required' => true))
		     ->add('phone', 'number', array('required' => true))
		     ->add('website', 'url', array('required' => true))
		     ->add('next', 'submit');
	}

	public function getName()
	{
		return 'professorAbout';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Acatism\MainBundle\Entity\Professor',
			));
	}
}