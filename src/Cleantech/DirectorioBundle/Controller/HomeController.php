<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Cleantech\DirectorioBundle\Entity\Directorio;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    
    public function indexAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('CleantechDirectorioBundle:Directorio:index.html.twig', array('last_username' => $lastUsername, 'error' => $error));
    }

}
