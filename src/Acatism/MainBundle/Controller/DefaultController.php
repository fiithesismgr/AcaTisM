<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acatism\MainBundle\Document\Student;
use Acatism\MainBundle\Document\Professor;
use Acatism\MainBundle\Document\Collaboration;
use Acatism\MainBundle\Form\Type\StudentAboutType;
use Acatism\MainBundle\Form\Type\StudentCvType;
use Acatism\MainBundle\Form\Type\ProfessorAboutType;
use Acatism\MainBundle\Form\Type\ProfessorCvType;
use Acatism\MainBundle\Form\Type\PersonUploadType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
                $qb = $dm->createQueryBuilder('AcatismMainBundle:Application')
                         ->field('student')->references($user);
                $applications = $qb->getQuery()->execute();


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
                                 'tasklist' => $tasklist
                            ));
                }
                else
                {
                    return $this->render('AcatismMainBundle:Show:StudView.html.twig',
                           array('student' => $student,
                                 'applicationlist' => $applications
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

                return $this->render('AcatismMainBundle:Show:ProfView.html.twig',
                  array('professor' => $professor,
                        'projectlist' => $projects,
                        'tasklist' => $tasks,
                        'applicationlist' => $applications,
                        'projectsApplications' => $projectsApplications,
                        'postlist' => $posts
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
      $dm = $this->get('doctrine_mongodb')->getManager();

      $qb = $dm->createQueryBuilder('AcatismMainBundle:NewsItem')
               ->field('title')->notEqual('ept');
      $newsItems = $qb->getQuery()->getSingleResult();

      $feed = $this->get('eko_feed.feed.manager')->get('article');
      $feed->add($newsItems);

      $response = new Response($feed->render('atom'));
      $response->headers->set('Content-Type', 'text/xml');
      return $response;
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

}
