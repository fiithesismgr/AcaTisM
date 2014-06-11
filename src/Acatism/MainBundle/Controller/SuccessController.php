<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security;

class SuccessController extends Controller
{
    public function successAction()
    {

                return $this->render('AcatismMainBundle:Show:Success.html.twig');


    }

}
