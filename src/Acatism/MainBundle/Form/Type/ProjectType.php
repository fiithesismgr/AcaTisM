<?php

// src/Acatism/MainBundle/Form/Type/ProjectType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text',  array('required' => true))
            ->add('description', 'text',  array('required' => true))
            ->add('Add', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acatism\MainBundle\Document\Project'
        ));
    }

    public function getName()
    {
        return 'project';
    }

}
