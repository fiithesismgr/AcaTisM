<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

            if($project->getProf() === $user){

                $em = $this->get('doctrine_mongodb')->getManager();
                $em->remove($project);
                $em->flush();

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

            if($task->getUser() === $user){

                $em = $this->get('doctrine_mongodb')->getManager();
                $em->remove($task);
                $em->flush();

                return $this->redirect($this->generateUrl('acatism_main_homepage'));

            }

        }

        else
            return $this->redirect($this->generateUrl('acatism_main_homepage'));

    }


    }

?>

