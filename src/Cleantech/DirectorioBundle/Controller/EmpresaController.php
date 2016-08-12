<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Cleantech\DirectorioBundle\Entity\Empresa;
use Cleantech\DirectorioBundle\Form\EmpresaType;
use Cleantech\DirectorioBundle\Form\EmpresaAddType;

class EmpresaController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
       
        $empresas = $em->getRepository('CleantechDirectorioBundle:Empresa')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $empresas, $request->query->getInt('page',1),
            3
            
            
        );
        
        return $this->render('CleantechDirectorioBundle:Empresa:empresas.html.twig', array('empresas' => $pagination ));
    }

    public function addAction()
    {
        $empresa = new Empresa();
        $form = $this->createCreateForm($empresa);
        
        return $this->render('CleantechDirectorioBundle:Empresa:add.html.twig', array('form' => $form->createView()));
    }
    
    public function createCreateForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaAddType(), $entity, array('action' => $this->generateUrl('cleantech_empresa_create'),'method' =>'POST' ));
    
        return $form;
    }
    
    public function createAction(Request $request)
    {
        $empresa = new Empresa();
        $form  = $this->createCreateForm($empresa);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            
            
            $empresa->setRamaTecnologica('');
            $empresa->setIndustria('');
            
            $empresa->setEstado('');
            $empresa->setTelefono('');
            $empresa->setServicio('');
            $empresa->setDescripcion('');
            $em->persist($empresa);
            $em->flush();
            
            return $this->redirectToRoute('cleantech_empresa_empresas');
        }
        
        return $this->render('CleantechDirectorioBundle:Empresa:add.html.twig', array('form' => $form->createView()));
    }
    
    public function viewAction($id)
    {
        $empresa = $this->getDoctrine()->getRepository('CleantechDirectorioBundle:Empresa')->find($id);
        
        if(!$empresa)
        {
             throw $this->createNotFoundException('Empresa Not Found');
        }
        
        $deleteForm = $this->createCustomForm($empresa->getId(), 'DELETE', 'cleantech_empresa_delete');
        $user = $empresa->getUser();
        
        return $this->render('CleantechDirectorioBundle:Empresa:view.html.twig', array('empresa' => $empresa, 'user' => $user, 'delete_form' => $deleteForm->createView() ));
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->find($id);
        
        if(!$empresa)
        {
             throw $this->createNotFoundException('Empresa Not Found');
        }
        
        $form = $this->createEditForm($empresa);
        
        return $this->render('CleantechDirectorioBundle:Empresa:edit.html.twig', array('empresa' => $empresa, 'form' => $form->createView()));
        
    }
    
    public function createEditForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaAddType(), $entity, array('action' => $this->generateUrl('cleantech_empresa_update', array('id' => $entity->getId() )),'method' =>'PUT' ));
        
        return $form;
    }
    
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->find($id);
         
        if(!$empresa)
        {
             throw $this->createNotFoundException('Empresa Not Found');
        }
        
        $form = $this->createEditForm($empresa);
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid())
        {
            
            
            $em->flush();
            return $this->redirectToRoute('cleantech_empresa_edit', array('id' => $empresa->getId()));
        }
        
        return $this->render('CleantechDirectorioBundle:Empresa:edit.html.twig', array('empresa' => $empresa, 'form' => $form->createView() ));
    }
    
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->find($id);
        
        if(!$empresa)
        {
             throw $this->createNotFoundException('Empresa Not Found');
        }
        
        $form = $this->createCustomForm($empresa->getId(), 'DELETE', 'cleantech_empresa_delete');
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid())
        {
            
            $em->remove($empresa);
            $em->flush();
            
            return $this->redirectToRoute('cleantech_empresa_empresas');
        }
        
        return $this->render('CleantechDirectorioBundle:Empresa:edit.html.twig', array('empresa' => $empresa, 'form' => $form->createView() ));
    }
    
    private function createCustomForm($id, $method,$route)
    {
        return $this->createFormBuilder()
        ->setAction($this->generateUrl($route, array('id' => $id )))
        ->setMethod($method)
        ->getForm();
        
    }
}
