<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $config = $this->get('app.configuration')->configuration();

        return $this->render('FrontBundle:Default:index.html.twig', compact('config'));
    }
}
