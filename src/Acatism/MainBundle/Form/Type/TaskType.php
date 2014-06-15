<?php

// src/Acatism/MainBundle/Form/Type/TaskType.php

namespace Acatism\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text',  array('required' => true))
            ->add('description', 'textarea',  array('required' => true))
            ->add('dueDate', 'date',  array('required' => true))
            ->add('requireFile', 'checkbox',  array('label' => 'Require document', 'required' => false))
            ->add('requireFileFormat', 'checkbox',  array('label' => 'Require document to respect the defined format', 'required' => false))
            ->add('requireSourceCode', 'checkbox',  array('label' => 'Require source code', 'required' => false))
            ->add('finish', 'submit', array('label' => 'Add task'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acatism\MainBundle\Document\Task'
        ));
    }

    public function getName()
    {
        return 'task';
    }

}

?>
