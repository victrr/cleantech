<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cleantech\DirectorioBundle\Entity\User;
class LoginController extends Controller
{
    
    public function indexAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();
       
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $user =  $this -> getUser ();
            
          
        if($user->getRole() == 'ROLE_ADMIN' or $user->getRole() == ('ROLE_SUPER_ADMIN'))
        {
            
            $users = $em->getRepository('CleantechDirectorioBundle:User');
            $dropuser = $em->getRepository('CleantechDirectorioBundle:DropUser');
            $empresas = $em->getRepository('CleantechDirectorioBundle:Empresa');
            $mensajes = $em->getRepository('CleantechDirectorioBundle:Mensaje');
            
            $query = $users->createQueryBuilder('u')
                ->select('count(u.id)')
                ->getQuery();
             
            $datoU = $query->getSingleScalarResult();
            
            $query = $empresas->createQueryBuilder('e')
                ->select('count(e.id)')
                ->getQuery();
             
            $datoE = $query->getSingleScalarResult();
            
            $query = $mensajes->createQueryBuilder('m')
                ->select('count(m.id)')
                ->getQuery();
             
            $datoM = $query->getSingleScalarResult();
            
            $query = $users->createQueryBuilder('u')
                ->select('u.email')
                ->orderBy('u.id', 'DESC')
                ->setMaxResults(5)
                ->getQuery();
             
            $datoN = $query->getResult();
            
            $query = $empresas->createQueryBuilder('e')
                ->select('e.nombre')
                ->orderBy('e.id', 'DESC')
                ->setMaxResults(5)
                ->getQuery();
             
            $datoEm = $query->getResult();
            
            $query = $mensajes->createQueryBuilder('m')
                ->select('m.nombreMensaje')
                ->orderBy('m.id', 'DESC')
                ->setMaxResults(5)
                ->getQuery();
             
            $datoMe = $query->getResult();
            
            $query = $dropuser->createQueryBuilder('du')
                ->select('du.email')
                ->orderBy('du.id', 'DESC')
                ->setMaxResults(5)
                ->getQuery();
             
            $datoDu = $query->getResult();
            
            
            return $this->render('CleantechDirectorioBundle:Directorio:panel.html.twig', array('datou' => $datoU, 'datoe' => $datoE, 'datom' => $datoM, 'daton' => $datoN, 'datoem' => $datoEm, 'datome' => $datoMe, 'datodu' => $datoDu));
        }
            
        else if($user->getRole() == 'ROLE_USER')
        {
            
        $datos = $em->getRepository('CleantechDirectorioBundle:Mensaje')->findAll();
        /*$mensaje = $em->getRepository('CleantechDirectorioBundle:Empresa')->findOneByUser($user); */
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $datos, $request->query->getInt('page',1),
            2
            
            
        );
        
        
       if(!$user->getRole('ROLE_ADMIN'))
       {
            return $this->redirectToRoute('cleantech_directorio_index');
       }
       
            return $this->render('CleantechDirectorioBundle:Directorio:perfil.html.twig', array('pagination' => $pagination));
       
            
        }
         
        
        return $this->redirectToRoute('cleantech_directorio_index');
    }

    public function loginCheckAction()
    {
            
    }
}
