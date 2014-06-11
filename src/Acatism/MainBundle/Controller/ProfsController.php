<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfsController extends Controller
{
    public function profsAction()
    {
        return $this->render('AcatismMainBundle:Show:profs.html.twig');
    }
}
