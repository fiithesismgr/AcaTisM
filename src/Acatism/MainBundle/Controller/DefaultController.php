<?php

namespace Acatism\MainBundle\Controller;

use Acatism\MainBundle\Document\SocialMedia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acatism\MainBundle\Document\Student;
use Acatism\MainBundle\Document\Professor;
use Acatism\MainBundle\Form\Type\PersonUploadType;
use Acatism\MainBundle\Document\Task;
use Acatism\MainBundle\Form\Type\TaskType;
use Acatism\MainBundle\Document\Project;
use Acatism\MainBundle\Document\Post;


class DefaultController extends Controller
{
   public function indexAction()
    {
        //
        if($this->get('security.context')->isGranted('ROLE_STUDENT') === true)
        {
            
            $student = $this->getStudentInformation();

            if(is_null($student))
            {
                $this->get('session')->set('person', new Student());
                return $this->redirect($this->generateUrl('wizard_first'));
            }
            else
            {
                $user = $this->getUser();

                $dm = $this->get('doctrine_mongodb')->getManager();

                // getting student social links
                $qb = $dm->createQueryBuilder('AcatismMainBundle:SocialMedia')
                         ->field('user')->references($user);
                $social = $qb->getQuery()->getSingleResult();

                // getting student applications
                $qb = $dm->createQueryBuilder('AcatismMainBundle:Application')
                         ->field('student')->references($user);
                $applications = $qb->getQuery()->execute();


                // if studdent has a collaboration, get his tasks

                if($student->getIsAccepted() === true)
                {
                    $qb = $dm->createQueryBuilder('AcatismMainBundle:Collaboration')
                             ->field('student')
                             ->references($user);
                    $collaboration = $qb->getQuery()->getSingleResult();

                    $supervisor = $collaboration->getProfessor();

                    $qb = $dm->createQueryBuilder('AcatismMainBundle:Task')
                             ->field('professor')->references($supervisor);

                    $tasklist = $qb->getQuery()->execute();

                    return $this->render('AcatismMainBundle:Show:StudView.html.twig',
                           array('student' => $student,
                                 'applicationlist' => $applications,
                                 'tasklist' => $tasklist,
                                 'sociallinks' => $social
                            ));
                }
                else
                {
                    return $this->render('AcatismMainBundle:Show:StudView.html.twig',
                           array('student' => $student,
                                 'applicationlist' => $applications,
                                 'sociallinks' => $social
                            ));
                } 
            }
        }
        elseif ($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true)
        {
            $professor = $this->getProfessorInformation();

            if(is_null($professor))
            {
                $this->get('session')->set('person', new Professor());
                return $this->redirect($this->generateUrl('wizard_first'));
            }
            else
            {

                $user = $this->getUser();

                $dm = $this->get('doctrine_mongodb')->getManager();

                // getting prof social links
                $qb = $dm->createQueryBuilder('AcatismMainBundle:SocialMedia')
                    ->field('user')->references($user);
                $social = $qb->getQuery()->getSingleResult();

                // getting project list
                $qb = $dm->createQueryBuilder('AcatismMainBundle:Project')
                         ->field('professor')->references($user)
                         ->sort('name', 'ASC');
                $projects = $qb->getQuery()->execute();

                // getting task list

                $qb = $dm->createQueryBuilder('AcatismMainBundle:Task')
                         ->field('professor')
                         ->references($user)
                         ->sort('dueDate', 'ASC');
                $tasks = $qb->getQuery()->execute();

                // getting application list

                $qb = $dm->createQueryBuilder('AcatismMainBundle:Application')
                    ->field('professor')->references($user);
                $applications = $qb->getQuery()->execute();


                // getting posts list

                $qb = $dm->createQueryBuilder('AcatismMainBundle:Post')
                    ->field('professor')->references($user)
                    ->sort('date', 'ASC');
                $posts = $qb->getQuery()->execute();

                $projectsApplications = array();

                /*

                foreach($applications as $application)
                {
                    $projectId = $application->getProject()->getId();
                    if(!isset($projectsApplications[$projectId]))
                    {
                        $projectsApplications[$projectId] = array();
                    }

                    array_push($projectsApplications[$projectId], $application);
                }

                var_dump($projectsApplications);

                return new Reponse('www'); */

                // creation forms generation

                $project = new Project();

                $project_form = $this->createFormBuilder($project)
                                ->setAction($this->generateUrl('acatism_new_project'))
                                ->add('name','text')
                                ->add('description','textarea')
                                ->add('Add','submit')
                                ->getForm();

                $task = new Task();

                $task_form = $this->createForm(new TaskType(), $task,
                                array('action' => $this->generateUrl('acatism_new_task'),
                             ));

                $post = new Post();

                $post_form = $this->createFormBuilder($post)
                            ->setAction($this->generateUrl('acatism_new_post'))
                            ->add('title','text')
                            ->add('content','textarea')
                            ->add('post','submit')
                            ->getForm();

                return $this->render('AcatismMainBundle:Show:ProfView.html.twig',
                  array('professor' => $professor,
                        'projectlist' => $projects,
                        'tasklist' => $tasks,
                        'applicationlist' => $applications,
                        'projectsApplications' => $projectsApplications,
                        'postlist' => $posts,
                        'sociallinks' => $social,
                        'project_form' => $project_form ->createView(),
                        'task_form' => $task_form ->createView(),
                        'post_form' => $post_form ->createView()
                        ));

            }
        }

        else
            return $this->redirect($this->generateUrl('login'));


    }

   public function wizardFirstAction(Request $request)
   {

        $person = $this->get('session')->get('person');

        if(is_null($person))
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }

        $form = $person->createAboutForm($this);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $this->get('session')->remove('person');
            $this->get('session')->set('person', $person);
            return $this->redirect($this->generateUrl('wizard_second'));
        }
        else
        {
            $viewtype = $this->getUser()->getRole()->getRole();
            return $this->render('AcatismMainBundle:Wizzard:WizzardFirstView.html.twig',
                    array('form' => $form->createView(),
                          'viewtype' => $viewtype
                    ));
        }         
   }

   public function wizardSecondAction(Request $request)
   {
        $person = $this->get('session')->get('person');

        if(is_null($person))
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }

        $form = $person->createCvForm($this);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            if($form->get('previous')->isClicked())
            {
                $this->get('session')->remove('person');
                $this->get('session')->set('person', $person);
                return $this->redirect($this->generateUrl('wizard_first'));
            }
            elseif($form->get('next')->isClicked())
            {
                
                $this->get('session')->remove('person');
                $this->get('session')->set('person', $person);
                return $this->redirect($this->generateUrl('wizard_third'));
            }
            else
            {    
                return new Response('Eroare');
            }
        }
        else
        {
            $viewtype = $this->getUser()->getRole()->getRole();
            return $this->render('AcatismMainBundle:Wizzard:WizzardSecondView.html.twig',
                array('form' => $form->createView(),
                    'viewtype' => $viewtype
                ));
        }      
   }

   public function wizardThirdAction(Request $request)
   {
        $person = $this->get('session')->get('person');

        if(is_null($person))
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }

        $form = $this->createForm(new PersonUploadType(), $person);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $person->setUser($this->getUser());
            $person->upload();
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($person);
            $dm->flush();
            $this->get('session')->remove('person');
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }
        else
        {
            $viewtype = $this->getUser()->getRole()->getRole();
            return $this->render('AcatismMainBundle:Wizzard:WizzardThirdView.html.twig',
                array('form' => $form->createView(),
                    'viewtype' => $viewtype
                ));
        }

        


   }

   public function newsFeedAction()
   {  
      if($this->get('security.context')->isGranted('ROLE_STUDENT') === true)
      {
         $dm = $this->get('doctrine_mongodb')->getManager();

         $qb = $dm->createQueryBuilder('AcatismMainBundle:NewsItem');
         $qb->addOr($qb->expr()->field('recipient')->references($this->getUser()));
         $qb->addOr($qb->expr()->field('forAllStuds')->equals(true));


         $newsItems = $qb->getQuery()->execute();

         $feed = $this->get('eko_feed.feed.manager')->get('article');
         foreach($newsItems as $newsItem)
         {
            $feed->add($newsItem);
         }
         

         $response = new Response($feed->render('atom'));
         $response->headers->set('Content-Type', 'text/xml');

         return $response;
      }
      elseif($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true)
      { 
          $dm = $this->get('doctrine_mongodb')->getManager();

         $qb = $dm->createQueryBuilder('AcatismMainBundle:NewsItem');
         $qb->addOr($qb->expr()->field('recipient')->references($this->getUser()));
         //$qb->addOr($qb->expr()->field('forAllStuds')->equals(true));


         $newsItems = $qb->getQuery()->execute();

         $feed = $this->get('eko_feed.feed.manager')->get('article');
         foreach($newsItems as $newsItem)
         {
            $feed->add($newsItem);
         }

         $response = new Response($feed->render('atom'));
         $response->headers->set('Content-Type', 'text/xml');

         return $response;
      }
      else
      {
          return new Response('error');
      }
      
   }

   public function getStudentInformation()
   {

      $dm = $this->get('doctrine_mongodb')->getManager();

      $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
               ->field('user')->references($this->getUser());
      return $qb->getQuery()->getSingleResult();
   }

   public function getProfessorInformation()
   {

      $dm = $this->get('doctrine_mongodb')->getManager();

      $qb = $dm->createQueryBuilder('AcatismMainBundle:Professor')
               ->field('user')->references($this->getUser());
      return $qb->getQuery()->getSingleResult();
   }

   public function profileSettingsAction(Request $request){

       // getting visitor Person entity

       $user = $this->getUser();

       $dm = $this->get('doctrine_mongodb')->getManager();

       if($this->get('security.context')->isGranted('ROLE_STUDENT') === true){

           $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
               ->field('user')->references($user);

           $person = $qb->getQuery()->getSingleResult();

       }


       if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){

           $qb = $dm->createQueryBuilder('AcatismMainBundle:Professor')
               ->field('user')->references($user);

           $person = $qb->getQuery()->getSingleResult();

       }



       $qb = $dm->createQueryBuilder('AcatismMainBundle:SocialMedia')
           ->field('user')->references($this->getUser());
       $social = $qb->getQuery()->getSingleResult();

       if(is_null($social)){

       $social = new SocialMedia();

       }

       $form = $this->createFormBuilder($social)
           ->setAction($this->generateUrl('acatism_update_social_links'))
           ->add('facebook','url', array('required' => false) )
           ->add('googleplus','url', array('required' => false) )
           ->add('twitter','url', array('required' => false) )
           ->add('skype','url', array('required' => false) )
           ->add('dropbox','url', array('required' => false) )
           ->add('github','url', array('required' => false) )
           ->add('update','submit')
           ->getForm();

       $form->handleRequest($request);

       if ($form->isValid()){

           $social->setUser($this->getUser());

           $dm->persist($social);
           $dm->flush();

           return $this->redirect($this->generateUrl('acatism_profile_settings'));
       }

       else{
           return $this->render('AcatismMainBundle:Show:Settings.html.twig',
               array(
                     'visitor' =>$person ,
                     'form' => $form->createView()
               ));
           }

   }

}
