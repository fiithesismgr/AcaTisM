<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acatism\MainBundle\Document\Student;
use Acatism\MainBundle\Document\Professor;
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
                return $this->render('AcatismMainBundle:Show:StudView.html.twig',
                  array('student' => $student));
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
                $qb = $dm->createQueryBuilder('AcatismMainBundle:Project')
                         ->field('prof')->references($user)
                         ->sort('name', 'ASC');
                $projects = $qb->getQuery()->execute();


                return $this->render('AcatismMainBundle:Show:ProfView.html.twig',
                  array('professor' => $professor, 'projectlist' => $projects));
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
            $viewtype = $this->getUser()->getRole()->getRole();
>>>>>>> 43b33edd391fae8d60f3112045f2d915a8bbd99b
=======
            $viewtype = $this->getUser()->getRole()->getRole();
>>>>>>> 43b33edd391fae8d60f3112045f2d915a8bbd99b
            return $this->render('AcatismMainBundle:Show:WizzardFirstView.html.twig',
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
            return $this->render('AcatismMainBundle:Show:WizzardSecondView.html.twig',
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
            return $this->render('AcatismMainBundle:Show:WizzardThirdView.html.twig',
                array('form' => $form->createView(),
                    'viewtype' => $viewtype
                ));
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
}
