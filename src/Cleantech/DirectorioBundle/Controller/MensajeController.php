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
            $this->addFlash('success','Se ha creado un nuevo mensaje.');
            return $this->redirectToRoute('cleantech_mensaje_add');
        }
        
        return $this->render('CleantechDirectorioBundle:Mensaje:add.html.twig', array('form' => $form->createView()));
    }
    
    public function viewAction($id)
    {
        $mensaje = $this->getDoctrine()->getRepository('CleantechDirectorioBundle:Mensaje')->find($id);
        
        if(!$mensaje)
        {
             throw $this->createNotFoundException('Mensaje Not Found');
        }
        
        $deleteForm = $this->createCustomForm($mensaje->getId(), 'DELETE', 'cleantech_mensaje_delete');
        $user = $mensaje->getUser();
        
        return $this->render('CleantechDirectorioBundle:Mensaje:view.html.twig', array('mensaje' => $mensaje, 'user' => $user, 'delete_form' => $deleteForm->createView() ));
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $mensaje = $em->getRepository('CleantechDirectorioBundle:Mensaje')->find($id);
        
        if(!$mensaje)
        {
             throw $this->createNotFoundException('Mensaje Not Found');
        }
        
        $form = $this->createEditForm($mensaje);
        
        return $this->render('CleantechDirectorioBundle:Mensaje:edit.html.twig', array('mensaje' => $mensaje, 'form' => $form->createView()));
        
    }
    
    public function createEditForm(Mensaje $entity)
    {
        $form = $this->createForm(new MensajeType(), $entity, array('action' => $this->generateUrl('cleantech_mensaje_update', array('id' => $entity->getId() )),'method' =>'PUT' ));
        
        return $form;
    }
    
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $mensaje = $em->getRepository('CleantechDirectorioBundle:Mensaje')->find($id);
         
        if(!$mensaje)
        {
             throw $this->createNotFoundException('Mensaje Not Found');
        }
        
        $form = $this->createEditForm($mensaje);
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid())
        {
            
            
            $em->flush();
            $this->addFlash('success','Se han guardado los cambios.');
            return $this->redirectToRoute('cleantech_mensaje_edit', array('id' => $mensaje->getId()));
        }
        
        return $this->render('CleantechDirectorioBundle:Mensaje:edit.html.twig', array('mensaje' => $mensaje, 'form' => $form->createView() ));
    }
    
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $mensaje = $em->getRepository('CleantechDirectorioBundle:Mensaje')->find($id);
        
        if(!$mensaje)
        {
             throw $this->createNotFoundException('Mensaje Not Found');
        }
        
        $form = $this->createCustomForm($mensaje->getId(), 'DELETE', 'cleantech_mensaje_delete');
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid())
        {
            
            $em->remove($mensaje);
            $em->flush();
            $this->addFlash('success','Se ha eliminado el mensaje correctamente');
            return $this->redirectToRoute('cleantech_mensaje_mensajes');
        }
        
        return $this->render('CleantechDirectorioBundle:Mensaje:edit.html.twig', array('mensaje' => $mensaje, 'form' => $form->createView() ));
    }
    
    private function createCustomForm($id, $method,$route)
    {
        return $this->createFormBuilder()
        ->setAction($this->generateUrl($route, array('id' => $id )))
        ->setMethod($method)
        ->getForm();
        
    }
    
    
    public function buscarMensajeAction(Request $request)
    {
        
      
        $em = $this->getDoctrine()->getManager();
        $mensajes = $em->getRepository('CleantechDirectorioBundle:Mensaje');
        
        if($request->getMethod()=="POST")
        {
            $buscar = $request->get("buscar");
            $send = $request->get("send");
            
            if($buscar)
            {
            $query = $mensajes->createQueryBuilder('e')
                    ->where('e.nombreMensaje like :nombre')
                    //->where('e.descripcion like :nombre')
                    ->setParameter('nombre', '%'.$buscar.'%')
                    ->getQuery();
                $mensaje = $query->getResult();
                
                 $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $mensaje, $request->query->getInt('page',1),
            5
            
            
        );

               
            return $this->render('CleantechDirectorioBundle:Mensaje:mensajes.html.twig', array('mensajes' => $pagination ));
            
            }
            
            else if($send)
            {
                return $this->redirectToRoute('cleantech_mensaje_mensajes');   
            }
            
            
        }
        
       
    }
}
