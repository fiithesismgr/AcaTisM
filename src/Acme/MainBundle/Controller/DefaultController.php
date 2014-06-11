<?php

namespace Acme\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

		/* 
		$account = new Account();

		$form = $this->createFormBuilder($account)
				->add('username','text')
				->add('password','password')
				->add('save','submit')
				->getForm();   

		$form->handleRequest($request);

		if($form->isValid()) {

				$user = $account->getUsername();
				$pass = $account->getPassword(); 

				return $this->render('MainBundle:Welcome:userwelcome.html.twig',array('user' => $user, 'password' => $pass));

		} 	

        return $this->render('MainBundle:LoginViews:index.html.twig',array('form' => $form->createView()));
		*/
		
		/* if session active
		
		return $this->render('MainBundle:LoginViews:index.html.twig',array('message' => 'Welcome HOME !'));

		else 
		*/

        /* $session = $this->getRequest()->getSession();

        if ($session->get('username')){

            $user = $session->get('username');

            return $this->render('MainBundle:Show:MainView.html.twig',array('username' => $user));

        }



        else
		return $this->redirect('login'); */

        return $this->render('MainBundle:Show:MainView.html.twig');
		
    }
	
}
