<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Acatism\MainBundle\Form\Type\ProjectType;
use Acatism\MainBundle\Document\Project;
use Acatism\MainBundle\Form\Type\TaskType;
use Acatism\MainBundle\Document\Task;

class CreationController extends Controller{

public function newProjectAction(Request $request){

    $project = new Project();
    /* $form = $this->createForm(new ProjectType(), $project,
        array('action' => $this->generateUrl('acatism_new_project'),
        )); */

    $form = $this->createFormBuilder($project)
        ->setAction($this->generateUrl('acatism_new_project'))
        ->add('name','text')
        ->add('description','textarea')
        ->add('Add','submit')
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()){

        $user = $this->getUser();

        //$id = $user->getId();

        $project->setProfessor($user);
        $project->setName($form->get('name')->getData());
        $project->setDescription($form->get('description')->getData());


        $em = $this->get('doctrine_mongodb')->getManager();
        $em->persist($project);
        $em->flush();

        return $this->redirect($this->generateUrl('acatism_main_homepage'));
    }

    else{
        return $this->render('AcatismMainBundle:Creation:NewProjectCreation.html.twig',
            array('form' => $form->createView(),
            ));
    }
}

    public function newTaskAction(Request $request){

        $task = new Task();

            $form = $this->createForm(new TaskType(), $task,
            array('action' => $this->generateUrl('acatism_new_task'),
            ));

        $form->handleRequest($request);

        if ($form->isValid()){

            $user = $this->getUser();

            $task->setProfessor($user);
            $task->setTitle($form->get('title')->getData());
            $task->setDescription($form->get('description')->getData());
            $task->setDueDate($form->get('dueDate')->getData());
            $task->setRequireFile($form->get('requireFile')->getData());
            $task->setRequireFile($form->get('requireFileFormat')->getData());
            $task->setRequireSourceCode($form->get('requireSourceCode')->getData());

            $em = $this->get('doctrine_mongodb')->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('acatism_main_homepage'));

        }

        else{
            return $this->render('AcatismMainBundle:Creation:NewTaskCreation.html.twig',
                array('form' => $form->createView(),
                ));
         }
    }




}

?>

