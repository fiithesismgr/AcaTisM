<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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

        $student = $this->get('doctrine_mongodb')
        					->getRepository('AcatismMainBundle:Student')
        					->findOneBy(array('user' => $user));
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

}
