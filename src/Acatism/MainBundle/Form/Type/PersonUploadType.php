<?php
// src/Acatism/MainBundle/Form/Type/PersonUploadType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonUploadType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		     ->add('profileFile', 'file',  array('required' => false, 'label' => 'Profile image'))
		     ->add('cvFile', 'file',  array('required' => true, 'label' => 'Curriculum Vitae'))
		     ->add('finish', 'submit', array('label' => 'Finish'));
	}

	public function getName()
	{
		return 'personUpload';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Acatism\MainBundle\Entity\Person',
			));
	}
}