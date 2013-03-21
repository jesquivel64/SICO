<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UNAHSGOBundle:Default:index.html.twig');
    }
}
