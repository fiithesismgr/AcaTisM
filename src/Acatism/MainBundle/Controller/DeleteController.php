<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ODM\MongoDB\Cursor;


// Controller for deleting tasks, projects
class DeleteController extends Controller{

    // Action for projects deletion
    public function deleteProjectAction($project_id){

        // if user has professor role
        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){

            // getting current user
            $user = $this->getUser();

            // searching the project object by the given id
            $project = $this->get('doctrine_mongodb')
                ->getRepository('AcatismMainBundle:Project')
                ->findOneBy(array('id' => $project_id));

            // if the project is owned by the current professor, delete it

            if($project->getProfessor() === $user){

                
                $dm = $this->get('doctrine_mongodb')->getManager();
                $qb = $dm->createQueryBuilder('AcatismMainBundle:Application')
                         ->field('project')->references($project);
                $applications = $qb->getQuery()->execute();
                foreach($applications as $application)
                {
                   $dm->remove($application);
                    
                }

                

                $dm->remove($project);
                $dm->flush();

                return $this->redirect($this->generateUrl('acatism_main_homepage'));

            }

        }

        else
          return $this->redirect($this->generateUrl('acatism_main_homepage'));

        }

    // Action for tasks deletion
    public function deleteTaskAction($task_id){

        // if user has professor role
        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){

            // getting current user
            $user = $this->getUser();

            // searching the task object by the given id
            $task = $this->get('doctrine_mongodb')
                ->getRepository('AcatismMainBundle:Task')
                ->findOneBy(array('id' => $task_id));

            // if the project is owned by the current professor, delete it

            if($task->getProfessor() === $user){

                $em = $this->get('doctrine_mongodb')->getManager();
                $em->remove($task);
                $em->flush();

                return $this->redirect($this->generateUrl('acatism_main_homepage'));

            }
        }
        else
        {
            return $this->redirect($this->generateUrl('acatism_main_homepage'));
        }

    }

    public function cancelApplicationAction($proj_id)
    {
        if($this->get('security.context')->isGranted('ROLE_STUDENT') === true)
        {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $project = $dm->getRepository('AcatismMainBundle:Project')
                          ->findOneBy(array('id' => $proj_id));

            $qb = $dm->createQueryBuilder('AcatismMainBundle:Application');
            $qb->addOr($qb->expr()->field('project')->references($project));
            $qb->addOr($qb->expr()->field('student')->references($this->getUser()));
            $application = $qb->getQuery()->getSingleResult();

            if(!is_null($application))
            {
                $dm->remove($application);
                $dm->flush();
            }
            if($this->getRequest()->isXmlHttpRequest())
            {
                return new Response('success');
            }
            else
            {
                return $this->redirect($this->generateUrl('acatism_main_homepage'));
            }
            
        }
        else
        {
            if($this->getRequest()->isXmlHttpRequest())
            {
                return new Response('failure');
            }
            else
            {
                return $this->redirect($this->generateUrl('acatism_main_homepage'));
            }
        }
    }
}

?>

