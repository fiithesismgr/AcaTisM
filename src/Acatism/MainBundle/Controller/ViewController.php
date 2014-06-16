<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acatism\AuthenticationBundle\Document\User;

class ViewController extends Controller
{
    public function viewStudentAction($username)
    {
        $user = $this->get('doctrine_mongodb')
            ->getRepository('AcatismAuthenticationBundle:User')
            ->findOneBy(array('username' => $username));

        if(is_null($user) || ($user->getRole()->getName() != 'student'))
        {
            throw $this->createNotFoundException('Student with username ' . $username . ' does not exist.');
        }

        if($user === $this->getUser())
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }

        $dm = $this->get('doctrine_mongodb')->getManager();

        $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
            ->field('user')->references($user);

        $student = $qb->getQuery()->getSingleResult();

        if(is_null($student))
        {
            throw $this->createNotFoundException('Student with username ' . $username . ' does not have a profile defined yet.');
        }

        return $this->render('AcatismMainBundle:Show:ViewStudProfile.html.twig',
            array('user' => $user, 'student' => $student));


    }

    public function viewAllStudentsAction()
    {
        return new Response('All students');
    }

    public function viewProfAction($username)
    {
        // searching user in db for getting info

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
        }
        

        return $this->render('AcatismMainBundle:Show:ViewProfProfile.html.twig',
            array('user' => $user,
                  'prof' => $prof,
                  'projectlist' => $projects,
                  'projectsStatusList' => $projectsStatusList
            ));


    }

    public function viewAllProfsAction()
    {
        return new Response('All professors');
    }

}
