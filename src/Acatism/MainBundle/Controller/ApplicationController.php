<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security;
use Acatism\MainBundle\Document\Collaboration;

class ApplicationController extends Controller
{

    public function acceptAction($applicationId)
    {
    	if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true) 
    	{
    		$dm = $this->get('doctrine_mongodb')->getManager();
    		$application = $dm->getRepository('AcatismMainBundle:Application')
                        	  ->findOneBy(array('id' => $applicationId));

            if($this->getUser() === $application->getProfessor() && $application->getStatus() === 'UNPROCESSED')
            {
            	$application->setStatus('WAITING_CONFIRMATION');
            	$dm->flush();


                $professor = $application->getProfessor();
                $student = $application->getStudent();
                $newsItem = new NewsItem();
                $newsItem->setTitle('Application accepted.');
                $newsItem->setDescription('Professor ' . $professor->getFirstname() . ' ' . $professor->getLastname() . ' has 
                    accepted your application for the thesis: ' . $project->getName());
                $newsItem->setPublicationDate(new DateTime('NOW'));
                $newsItem->setLink($this->generateUrl('acatism_view_prof', array('username' => $user->getUsername())));
                $newsItem->setAuthor($professor);

        $dm->persist($newsItem);
        $dm->flush();
            }

            return $this->redirect($this->generateUrl('acatism_main_homepage'));
    	}
    	else
    	{
    		return $this->redirect($this->generateUrl('acatism_main_homepage'));
    	}
    }

    public function declineAction($applicationId)
    {
    	if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true) 
    	{
    		$dm = $this->get('doctrine_mongodb')->getManager();
    		$application = $dm->getRepository('AcatismMainBundle:Application')
                        	  ->findOneBy(array('id' => $applicationId));

            if($this->getUser() === $application->getProfessor() && $application->getStatus() === 'UNPROCESSED')
            {
            	$application->setStatus('DECLINED');
            	$dm->flush();
            }

            return $this->redirect($this->generateUrl('acatism_main_homepage'));
    	}
    	else
    	{
    		return $this->redirect($this->generateUrl('acatism_main_homepage'));
    	}
    }

    public function confirmAction($applicationId)
    {
    	if($this->get('security.context')->isGranted('ROLE_STUDENT') === true) 
    	{
    		$dm = $this->get('doctrine_mongodb')->getManager();
    		$application = $dm->getRepository('AcatismMainBundle:Application')
                        	  ->findOneBy(array('id' => $applicationId));

            if($this->getUser() === $application->getStudent() && $application->getStatus()==='WAITING_CONFIRMATION') 
            {
            	$application->setStatus('ACCEPTED');
            	//$dm->flush();

                $collaboration = new Collaboration();
                $collaboration->setStudent($application->getStudent());
                $collaboration->setProfessor($application->getProfessor());
                $collaboration->setProject($application->getProject());

                $dm->persist($collaboration);
                //$dm->flush();

                $application->getProject()->setAssignedStud($application->getStudent());
                //$dm->flush();

                $qb = $dm->createQueryBuilder('AcatismMainBundle:Student')
                         ->field('user')->references($this->getUser());
                $student = $qb->getQuery()->getSingleResult();
                $student->setIsAccepted(true);
                $dm->flush();
            }

            return $this->redirect($this->generateUrl('acatism_main_homepage'));
    	}
    	else
    	{
    		return $this->render($this->generateUrl('acatism_main_homepage'));
    	}
    }

}
