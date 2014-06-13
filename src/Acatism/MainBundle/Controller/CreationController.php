<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Acatism\MainBundle\Form\Type\ProjectType;
use Acatism\MainBundle\Document\Project;

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

        $project->setProf($user);
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


}

?>

