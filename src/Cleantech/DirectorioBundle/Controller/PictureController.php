<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cleantech\DirectorioBundle\Entity\Document;
use Symfony\Component\HttpFoundation\Request;
use Cleantech\DirectorioBundle\Form\DocumentType;
use Cleantech\DirectorioBundle\Entity\Directorio;



class PictureController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
       
        $imagen = $em->getRepository('CleantechDirectorioBundle:Document')->findAll();
        
        if(!$imagen)
        {
             throw $this->createNotFoundException('Imagen no encontrada');
        }
        
        return $this->render('CleantechDirectorioBundle:Directorio:ver.html.twig', array('imagen' => $imagen ));
    }
    
    public function pruebaDirectorioAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository('CleantechDirectorioBundle:Empresa');
       
         $query = $empresas->createQueryBuilder('e')
            //->where('e.nombre like :nombre')
            //->setParameter('nombre', 'B%')
            ->getQuery();
        $empresa = $query->getResult();
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $empresa, $request->query->getInt('page',1),
            3
            
            
        );
        
        
        
        return $this->render('CleantechDirectorioBundle:Directorio:pruebaDirectorio.html.twig', array('pagination' => $pagination));
       // return $this->render('CleantechDirectorioBundle:Directorio:index.html.twig');
    }
    
    public function addAction()
    {
        $document = new Document();
        $form = $this->createCreateForm($document);
        
        return $this->render('CleantechDirectorioBundle:Directorio:prueba.html.twig', array('form' => $form->createView()));
    }
    
    public function createCreateForm(Document $entity)
    {
        $form = $this->createForm(new DocumentType(), $entity, array('action' => $this->generateUrl('cleantech_directorio_create'),'method' =>'POST' ));
    
        return $form;
    }
    
    public function createAction(Request $request)
    {
        $document = new Document();
        $form  = $this->createCreateForm($document);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $document->upload();
            $em->persist($document);
            $em->flush();
            
            return $this->redirectToRoute('cleantech_directorio_add');
        }
        
        return $this->render('CleantechDirectorioBundle:Directorio:prueba.html.twig', array('form' => $form->createView()));
    }
       
    
}
