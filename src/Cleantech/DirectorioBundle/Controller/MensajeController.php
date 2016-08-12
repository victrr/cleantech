<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Cleantech\DirectorioBundle\Entity\Mensaje;
use Cleantech\DirectorioBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Cleantech\DirectorioBundle\Form\MensajeType;

class MensajeController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
       
        $mensaje = $em->getRepository('CleantechDirectorioBundle:Mensaje')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $mensaje, $request->query->getInt('page',1),
            3
            
            
        );
        
        return $this->render('CleantechDirectorioBundle:Mensaje:mensajes.html.twig', array('mensajes' => $pagination ));
    }
    
    public function addAction()
    {
        $mensaje = new Mensaje();
        $form = $this->createCreateForm($mensaje);
        
        return $this->render('CleantechDirectorioBundle:Mensaje:add.html.twig', array('form' => $form->createView()));
    }
    
    public function createCreateForm(Mensaje $entity)
    {
        $form = $this->createForm(new MensajeType(), $entity, array('action' => $this->generateUrl('cleantech_mensaje_create'),'method' =>'POST' ));
    
        return $form;
    }
    
    public function createAction(Request $request)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $dato =  $this -> getUser ();
        
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('CleantechDirectorioBundle:User')->findOneById($dato);
        
        
        $mensaje = new Mensaje();
        $form  = $this->createCreateForm($mensaje);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            
            $mensaje->setUser($user);
            $em->persist($mensaje);
            $em->flush();
            
            return $this->redirectToRoute('cleantech_empresa_empresas');
        }
        
        return $this->render('CleantechDirectorioBundle:Empresa:add.html.twig', array('form' => $form->createView()));
    }
}
