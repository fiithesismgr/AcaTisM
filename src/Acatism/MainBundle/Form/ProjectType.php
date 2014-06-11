<?php
// src/Acatism/AuthenticationUndle/Form/Type/UserType.php

namespace Acatism\AuthenticationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text',  array('required' => true))
            ->add('lastname', 'text',  array('required' => true))
            ->add('email', 'email',  array('required' => true))
            ->add('username', 'text',  array('required' => true))
            ->add('password', 'password', array('required' => true, 'mapped' => false))
            ->add('role', 'choice', array(
                'choices' => array('student' => 'Student', 'professor' => 'Professor'),
                'required' => true,
                'multiple' => false,
                'expanded' =>true,
                'mapped' => false))
            ->add('register', 'submit');
    }

    public function getName()
    {
        return 'user';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acatism\AuthenticationBundle\Entity\User',
        ));
    }
}