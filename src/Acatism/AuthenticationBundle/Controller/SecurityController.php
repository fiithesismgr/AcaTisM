<?php

namespace Acatism\AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Acatism\AuthenticationBundle\Document\User;
use Acatism\AuthenticationBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
          $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
          $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
          $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }
        return $this->render(
          'AcatismAuthenticationBundle:Security:login.html.twig',
          array(
            'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
            'error' => $error,
            )
        );
   }

   public function registerAction(Request $request) 
   {

   	    $user = new User();

        $form = $this->createForm(new UserType(), $user,
          array('action' => $this->generateUrl('register'),
            ));

        $form->handleRequest($request);

   	   if ($form->isValid())
       {
          //return new Response('ept');
           $role = $this->get('doctrine_mongodb')
                        ->getRepository('AcatismAuthenticationBundle:Role')
                        ->findOneBy(array('name' => $form->get('role')->getData()));

           $user->setRole($role);

           $factory = $this->get('security.encoder_factory');

           $encoder = $factory->getEncoder($user);

           $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());

           $user->setPassword($password);

           $em = $this->get('doctrine_mongodb')->getManager();
           $em->persist($user);
           $em->flush();

           return $this->redirect($this->generateUrl('login'));
       }
       else
       {
           return $this->render('AcatismAuthenticationBundle:Security:register.html.twig',
                        array('form' => $form->createView(),
                      ));
       }

       
   	    
   }
   
}
