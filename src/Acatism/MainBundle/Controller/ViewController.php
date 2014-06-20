<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acatism\AuthenticationBundle\Document\User;

class ViewController extends Controller
{
    public function viewStudentAction($username){

        $person = null;

        $visitor_user = $this->getUser();

        $dm = $this->get('doctrine_mongodb')->getManager();

        // getting visitor Person entity ( visitor type )

        if($this->get('security.context')->isGranted('ROLE_STUDENT') === true){

            $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
                ->field('user')->references($visitor_user);

            $person = $qb->getQuery()->getSingleResult();

        }

        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){

            $qb = $dm->createQueryBuilder('AcatismMainBundle:Professor')
                ->field('user')->references($visitor_user);

            $person = $qb->getQuery()->getSingleResult();

        }

        ////////////////////////

        // getting info for visited student

        $visited_user = $this->get('doctrine_mongodb')
            ->getRepository('AcatismAuthenticationBundle:User')
            ->findOneBy(array('username' => $username));

        if(is_null($visited_user) || ($visited_user->getRole()->getName() != 'student'))
        {
            throw $this->createNotFoundException('Student with username ' . $username . ' does not exist.');
        }

        if($visited_user === $this->getUser())
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }

        $dm = $this->get('doctrine_mongodb')->getManager();

        $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
            ->field('user')->references($visited_user);

        $student = $qb->getQuery()->getSingleResult();

        if(is_null($student))
        {
            throw $this->createNotFoundException('Student with username ' . $username . ' does not have a profile defined yet.');
        }

        ///////////////////////


        // if the visitor is a Professor, check if there is an existent Collaboration between him and the visited stud

        $existsCollaboration = false;

        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){


        $qb = $dm->createQueryBuilder('AcatismMainBundle:Collaboration')
            ->field('professor')->references($person)
            ->field('student')->references($student);

        $collaboration = $qb->getQuery()->getSingleResult();

            if(!is_null($collaboration)){
                $existsCollaboration = true ; // collaboration existent

                // getting the tasks
                $qb = $dm->createQueryBuilder('AcatismMainBundle:Task')
                    ->field('professor')->references($person);

                $taskList = $qb->getQuery()->execute();


                return $this->render('AcatismMainBundle:Show:ViewStudProfile.html.twig',
                    array('user' => $visited_user,
                        'student' => $student,
                        'visitor' => $person,
                        'existsCollaboration' => $existsCollaboration,
                        'taskList' => $taskList ));

            }

        }

        //////////////////////

        // rendering view

        return $this->render('AcatismMainBundle:Show:ViewStudProfile.html.twig',
            array('user' => $visited_user,
                  'student' => $student,
                  'visitor' => $person,
                  'existsCollaboration' => $existsCollaboration
            ));


    }

    public function viewAllStudentsAction(){

        $dm = $this->get('doctrine_mongodb')->getManager();

        $profs = $this->get('doctrine_mongodb')
            ->getRepository('AcatismMainBundle:Student')
            ->findAll();

        $user = $this->getUser();

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


        return $this->render('AcatismMainBundle:Users:ViewAllStuds.html.twig',
            array( 'studlist' => $profs,
                   'visitor' => $person )
        );


    }

    public function viewProfAction($username){

        // getting visitor Person entity

        $user = $this->getUser();

        if($this->get('security.context')->isGranted('ROLE_STUDENT') === true){

            $dm = $this->get('doctrine_mongodb')->getManager();

            $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
                ->field('user')->references($user);

            $person = $qb->getQuery()->getSingleResult();

        }


        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){

            $dm = $this->get('doctrine_mongodb')->getManager();

            $qb = $dm->createQueryBuilder('AcatismMainBundle:Professor')
                ->field('user')->references($user);

            $person = $qb->getQuery()->getSingleResult();

        }


        // getting visited professor info

        $user = $this->get('doctrine_mongodb')
            ->getRepository('AcatismAuthenticationBundle:User')
            ->findOneBy(array('username' => $username));

        if(is_null($user) || ($user->getRole()->getName() != 'professor'))
        {
            throw $this->createNotFoundException('Professor with username ' . $username . ' does not exist.');
        }

        // if current user tries to access its page, homepage redirection

        if($user === $this->getUser())
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }


        $dm = $this->get('doctrine_mongodb')->getManager();

        $qb = $dm->createQueryBuilder('AcatismMainBundle:Professor')
            ->field('user')->references($user);

        $prof = $qb->getQuery()->getSingleResult();

        if(is_null($prof))
        {
            throw $this->createNotFoundException('Professor with username ' . $username . ' does not have a profile defined yet.');
        }


        $qb = $dm->createQueryBuilder('AcatismMainBundle:Project')
            ->field('professor')->references($prof->getUser())
            ->sort('name', 'ASC');
        $projects = $qb->getQuery()->execute();


        $studIsAccepted = false;

        $projectsStatusList = array();


        if($this->getUser()->getRole()->getName() === 'student')
        {

            $dm = $this->get('doctrine_mongodb')->getManager();
            $qb = $dm->createQueryBuilder('AcatismMainBundle:Application');
            $qb->addOr($qb->expr()->field('professor')->references($prof));
            $qb->addOr($qb->expr()->field('student')->references($this->getUser()));
            $applications = $qb->getQuery()->execute();
            foreach($applications as $application)
            {
                $projectId = $application->getProject()->getId();
                $projectsStatusList[$projectId] = true;
            }

            $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
                ->field('user')->references($this->getUser());
            $stud = $qb->getQuery()->getSingleResult();

            if(!( is_null($stud) ))
            $studIsAccepted = $stud->getIsAccepted();

        }
        

        return $this->render('AcatismMainBundle:Show:ViewProfProfile.html.twig',
            array('user' => $user,
                  'prof' => $prof,
                  'visitor' => $person,
                  'projectlist' => $projects,
                  'projectsStatusList' => $projectsStatusList,
                  'studIsAccepted' => $studIsAccepted
                  ));


    }

    public function viewAllProfsAction(){

        $dm = $this->get('doctrine_mongodb')->getManager();

        $profs = $this->get('doctrine_mongodb')
            ->getRepository('AcatismMainBundle:Professor')
            ->findAll();

        $user = $this->getUser();

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


        return $this->render('AcatismMainBundle:Users:ViewAllProfs.html.twig',
            array( 'proflist' => $profs,
                  'visitor' => $person )
            );

    }

}
