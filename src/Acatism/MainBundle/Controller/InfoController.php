<?php

namespace Acatism\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoController extends Controller
{

    public function aboutAction(){

        return $this->render('AcatismMainBundle:Info:About.html.twig');

    }

    public function userguideAction(){

        return $this->render('AcatismMainBundle:Info:UserGuide.html.twig');

    }

}
