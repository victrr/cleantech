<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Cleantech\DirectorioBundle\Entity\Directorio;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
         $em = $this->getDoctrine()->getManager();
       
       
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->findAll();
    
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $empresa, $request->query->getInt('page',1),
            5
            
            
        );
        
        return $this->render('CleantechDirectorioBundle:Directorio:index.html.twig', array('last_username' => $lastUsername, 'error' => $error,'pagination' => $pagination));
    }

    public function buscadorLetraAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $em = $this->getDoctrine()->getManager();
        $mensaje = $em->getRepository('CleantechDirectorioBundle:Empresa');//Mensaje es la entidad q contiene los d
        
        if($request->getMethod()=="POST")
        {
            $buscar = $request->get("buscar");
            $send = $request->get("send");
            
            if($buscar)
            {
            $query = $mensaje->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    //->where('e.descripcion like :nombre')
                    ->setParameter('nombre', '%'.$buscar.'%')
                    ->getQuery();
                $datos = $query->getResult();
                
                 $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $datos, $request->query->getInt('page',1),
            5
            
            
        );
        
               
                    return $this->render('CleantechDirectorioBundle:Directorio:index.html.twig', array('last_username' => $lastUsername, 'error' => $error, 'pagination' => $pagination));    
            
            }
            
            else if($send)
            {
                
       
            $datos = $em->getRepository('CleantechDirectorioBundle:Empresa')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $datos, $request->query->getInt('page',1),
            5
            
            
        );
        
        //$deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'cleantech_user_delete');
        
         return $this->render('CleantechDirectorioBundle:Directorio:index.html.twig', array('last_username' => $lastUsername, 'error' => $error, 'pagination' => $pagination));  
            
            }
            
            
        }
        
       
    }
    
    
}
