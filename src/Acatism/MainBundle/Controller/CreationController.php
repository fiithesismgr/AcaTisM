<?php

namespace Acatism\MainBundle\Controller;

use Acatism\MainBundle\Document\Application;
use Acatism\MainBundle\Document\NewsItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acatism\MainBundle\Form\Type\ProjectType;
use Acatism\MainBundle\Document\Project;
use Acatism\MainBundle\Document\Post;
use Acatism\MainBundle\Form\Type\TaskType;
use Acatism\MainBundle\Document\Task;
use Zend\Stdlib\DateTime;

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


        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($project);
        $dm->flush();

        $newsItem = new NewsItem();
        $newsItem->setTitle('New Project.');
        $newsItem->setDescription('The professor ' . $user->getFirstname() . ' ' . $user->getLastname() . ' has added a new thesis
            theme entitled: ' . $project->getName());
        $newsItem->setPublicationDate(new DateTime('NOW'));
        $newsItem->setLink($this->generateUrl('acatism_view_prof', array('username' => $user->getUsername())));
        $newsItem->setForAllStuds(true);

        $dm->persist($newsItem);
        $dm->flush();


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

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($task);
            $dm->flush();

            return $this->redirect($this->generateUrl('acatism_main_homepage'));

        }

        else{
            return $this->render('AcatismMainBundle:Creation:NewTaskCreation.html.twig',
                array('form' => $form->createView(),
                ));
         }
    }

public function newPostAction(Request $request){

        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true) 
        {
            $post = new Post();

            $form = $this->createFormBuilder($post)
                ->setAction($this->generateUrl('acatism_new_post'))
                ->add('title','text')
                ->add('content','textarea')
                ->add('post','submit')
                ->getForm();

            $form->handleRequest($request);

            if ($form->isValid()){

                $user = $this->getUser();

            //$id = $user->getId();

                $post->setProfessor($user);
                $post->setTitle($form->get('title')->getData());
                $post->setContent($form->get('content')->getData());
                $post->setDate(new DateTime('NOW'));


                $dm = $this->get('doctrine_mongodb')->getManager();

                $dm->persist($post);
            //$dm->flush();

                $newsItem = new NewsItem();
                $newsItem->setTitle('New Post');
                $newsItem->setDescription('The professor ' . $user->getFirstname() . ' ' . $user->getLastname() . ' 
                has added a new post: ' . $post->getTitle());
                $newsItem->setPublicationDate(new DateTime('NOW'));
                $newsItem->setLink($this->generateUrl('acatism_view_prof', array('username' => $user->getUsername())));
                $newsItem->setAuthor($user);

                $dm->persist($newsItem);
                $dm->flush();


                return $this->redirect($this->generateUrl('acatism_main_homepage'));
            }

            else{
                return $this->render('AcatismMainBundle:Creation:NewPostCreation.html.twig',
                     array('form' => $form->createView(),
                        ));
                }
        }
        else
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }
        
    }

public function newApplicationAction($proj_id)
{
        if($this->get('security.context')->isGranted('ROLE_STUDENT') === true)
        {   
            $user = $this->getUser();
            $app = new Application();

            $proj = $this->get('doctrine_mongodb')
                ->getRepository('AcatismMainBundle:Project')
                ->findOneBy(array('id' => $proj_id));

            $app->setStudent($this->getUser());
            $app->setProfessor($proj->getProfessor());
            $app->setProject($proj);

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($app);


            $newsItem = new NewsItem();
            $newsItem->setTitle('New application.');
            $newsItem->setDescription('The student ' . $user->getFirstname() . ' ' . $user->getLastname() . ' has applied for
                the thesis entitled: ' . $proj->getName());
            $newsItem->setPublicationDate(new DateTime('NOW'));
            $newsItem->setLink($this->generateUrl('acatism_view_student', array('username' => $user->getUsername())));

            $dm->flush();

            if($this->getRequest()->isXmlHttpRequest())
            {
                return new Response('success');
            }
            else
            {
                return $this->redirect($this->generateUrl('acatism_main_homepage'));
            }

            //return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }
        else
        {
            if($this->getRequest()->isXmlHttpRequest())
            {
                return new Response('fail');
            }
            else
            {
                return $this->redirect($this->generateUrl('acatism_main_homepage'));
            }
        }
        

    }

public function confirmTaskAction($id){

    return new Response('jaja');

}

}

?>

