<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Controller for deleting tasks, projects
class DeleteController extends Controller{

    // Action for deleting a project
    public function deleteProjectAction($project_id){

        // if user has professor role
        if($this->get('security.context')->isGranted('ROLE_PROFESSOR') === true){

            // getting current user
            $user = $this->getUser();

            // searching the project object by the given id
            $project = $this->getDoctrine()
                ->getRepository('AcatismMainBundle:Project')
                ->findOneById($project_id);

            // if the project is owned by the current professor, delete it

            if($project->getProf() === $user){

                $em = $this->getDoctrine()->getManager();
                $em->remove($project);
                $em->flush();

                return $this->redirect($this->generateUrl('acatism_main_homepage'));

            }

        }

        else
          return $this->redirect($this->generateUrl('acatism_main_homepage'));

        }


    }

?>

