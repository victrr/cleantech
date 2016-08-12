<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Cleantech\DirectorioBundle\Entity\User;
use Cleantech\DirectorioBundle\Entity\Empresa;
use Cleantech\DirectorioBundle\Form\DatoType;
use Cleantech\DirectorioBundle\Form\DatoEmpresaType;


class PerfilController extends Controller
{
    
    public function indexAction()
    {
       
        return $this->render('CleantechDirectorioBundle:Directorio:perfil.html.twig');
    }

    public function viewAction()
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $users =  $this -> getUser ();
        
        
        $em = $this->getDoctrine()->getManager();
       
        $datos = $em->getRepository('CleantechDirectorioBundle:Empresa')->findOneByUser($users);
        
        if(!$datos)
        {
             throw $this->createNotFoundException('Empresa no encontrada');
        }
        
        
        
        return $this->render('CleantechDirectorioBundle:Directorio:perfil.html.twig', array('dato' => $datos));
    }
    
    public function editAction()
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $user =  $this -> getUser ();
        
        $em = $this->getDoctrine()->getManager();
        $datos = $em->getRepository('CleantechDirectorioBundle:User')->find($user);
       
        if(!$datos)
        {
            throw $this->createNotFoundException('User Not Found');
        }
       
        $form = $this->createdEditForm($datos);
       
        return $this->render('CleantechDirectorioBundle:Perfil:configuracion.html.twig', array('dato' => $datos, 'form' => $form->createView()));
        
    }
    
    private function createdEditForm(User $entity)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $user =  $this -> getUser ();
        
         $form = $this->createForm(new DatoType(), $entity, array(
                'action' => $this->generateUrl('cleantech_perfil_update',
                array('id' => $entity->getId())), 
                'method' => 'PUT'
            ));
            
        return $form;
    }
    
    public function updateAction(Request $request)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $user =  $this -> getUser ();
        
        $em = $this->getDoctrine()->getManager();
        
        $datos = $em->getRepository('CleantechDirectorioBundle:User')->find($user);
        
        if(!$datos)
        {
            throw $this->createNotFoundException('User Not Found');
        }
        
        $form = $this->createdEditForm($datos);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $password = $form->get('password')->getData();
            #print_r($password);
            #exit();
            if(!empty ($password))
            {
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($datos, $password);
                $datos->setPassword($encoded);
            }
            else
            {
                $recoverPass = $this->recoverPass($user);
                $datos->setPassword($recoverPass[0]['password']);
            }
            
            $datos->upload();
            $datos->setRole('ROLE_USER');
            $datos->setIsActive(1);
            $em->flush();
            
            $this->addFlash('success','Se han actualizados sus datos.');
            return $this->redirectToRoute('cleantech_perfil_edit', array('id' => $datos->getId()));
        }
        
        return $this->render('CleantechDirectorioBundle:Perfil:configuracion.html.twig', array('dato' => $datos, 'form' => $form->createView()));   
    }
    
    private function recoverPass()
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $user =  $this -> getUser ();
        
        $em = $this->getDoctrine()->getManager();
        //$dato = $em->getRepository('CleantechDirectorioBundle:User')->find($user);
        $query = $em->createQuery(
            'SELECT u.password
            FROM CleantechDirectorioBundle:User u
            WHERE u.username = :id'
        )->setParameter('id', $user->getUsername());
        
        $currentPass = $query->getResult();
        #print_r($currentPass);
            #exit();
        
        return $currentPass;
    }
    
    public function editEmpresaAction()
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $users =  $this -> getUser ();
        
        $em = $this->getDoctrine()->getManager();
        
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->findOneByUser($users);
        
        if(!$empresa)
        {
             throw $this->createNotFoundException('Empresa Not Found');
        }
        
        $form = $this->createEditEmpresaForm($empresa);
        
        return $this->render('CleantechDirectorioBundle:Perfil:configuracionempresa.html.twig', array('empresa' => $empresa, 'form' => $form->createView()));
        
    }
    
    public function createEditEmpresaForm(Empresa $entity)
    {
        $form = $this->createForm(new DatoEmpresaType(), $entity, array('action' => $this->generateUrl('cleantech_perfil_empresa_update', array('id' => $entity->getId() )),'method' =>'PUT' ));
        
        return $form;
    }
    
    public function updateEmpresaAction(Request $request)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $users =  $this -> getUser ();
        
        $em = $this->getDoctrine()->getManager();
        
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->findOneByUser($users);
         
        if(!$empresa)
        {
             throw $this->createNotFoundException('Empresa Not Found');
        }
        
        $form = $this->createEditEmpresaForm($empresa);
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid())
        {
            $empresa->upload();
            $empresa->setUser($empresa->getUser());
            $em->flush();
            $this->addFlash('success','Se han actualizados los datos de su empresa.');
            return $this->redirectToRoute('cleantech_perfil_empresa_edit', array('id' => $empresa->getId()));
        }
        
        return $this->render('CleantechDirectorioBundle:Perfil:configuracionempresa.html.twig', array('empresa' => $empresa, 'form' => $form->createView() ));
    }
    
    public function buscadorGeneralAction(Request $request)
    {
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
               
                    return $this->render('CleantechDirectorioBundle:Perfil:users.html.twig', array('user' => $datos));    
            
            }
            
            else if($send)
            {
                
       
            $datos = $em->getRepository('CleantechDirectorioBundle:User')->findAll();
       
        
        
        //$deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'cleantech_user_delete');
        
         return $this->render('CleantechDirectorioBundle:Perfil:users.html.twig', array('user' => $datos));  
            
            }
            
            
        }
        
       
    }
    
}
