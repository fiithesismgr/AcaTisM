<?php

namespace Acatism\AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Acatism\AuthenticationBundle\Document\User;
use Acatism\AuthenticationBundle\Document\Role;
use Acatism\AuthenticationBundle\Document\Confirmation;
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

           $dm = $this->get('doctrine_mongodb')->getManager();
           $dm->persist($user);

           $confirmation = new Confirmation();
           $confirmation->setUser($user);
           $confirmation->setConfirmationHash(sha1(uniqid(mt_rand(), true)));
           $dm->persist($confirmation);

           $dm->flush();

           $message = \Swift_Message::newInstance()
                ->setSubject('Confirm account creation at AcaTisM.')
                ->setFrom('noreply.acatism@gmail.com')
                ->setTo($user->getEmail())
                ->setBody($this->generateUrl('acatism_confirmation', 
                            array('confirmationHash' => $confirmation->getConfirmationHash())));
           $this->get('mailer')->send($message);

           

           return $this->redirect($this->generateUrl('login'));
       }
       else
       {
           return $this->render('AcatismAuthenticationBundle:Security:register.html.twig',
                        array('form' => $form->createView(),
                      ));
       }


      
       /*
       $role1 = new Role();
       $role1->setName('student');
       $role1->setRole('ROLE_STUDENT');

       $role2 = new Role();
       $role2->setName('professor');
       $role2->setRole('ROLE_PROFESSOR');

       $dm = $this->get('doctrine_mongodb')->getManager();
       $dm->persist($role1);
       $dm->flush();

       $dm->persist($role2);
       $dm->flush();

       return new Response('wwoooow');
       */
   	    
   }

   public function confirmAction($confirmationHash) {
      /*
      $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('noreply.acatism@gmail.com')
                ->setTo('daniel.plecan@gmail.com')
                ->setBody('ept');
      $this->get('mailer')->send($message);
      */
      $dm = $this->get('doctrine_mongodb')->getManager();
      $qb = $dm->createQueryBuilder('AcatismAuthenticationBundle:Confirmation')
               ->field('confirmationHash')->equals($confirmationHash);   
      $confirmation = $qb->getQuery()->getSingleResult();
      if(is_null($confirmation)) {
          return new Response('Confirmation link is invalid.');
      } 
      $user = $confirmation->getUser();
      $user->setIsActive(true);
      $dm->remove($confirmation);
      $dm->flush();
      return new Response('Account '. $user->getUsername() . ' has been confirmed. You may now login.');


   }
   
}
