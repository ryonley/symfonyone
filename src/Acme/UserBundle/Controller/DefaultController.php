<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;



class DefaultController extends Controller
{

    public function indexAction($name)
    {
        $name = 'test';
        return $this->render('AcmeUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
