<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Cleantech\DirectorioBundle\Entity\User;
use Cleantech\DirectorioBundle\Form\UserType;
use Cleantech\DirectorioBundle\Form\UserAdminType;
use Cleantech\DirectorioBundle\Form\UserSuperAdminType;
use Cleantech\DirectorioBundle\Form\DatoType;


class UserController extends Controller
{
    
    public function indexAction(Request $request)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $sessions =  $this -> getUser ();
        
        
        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('CleantechDirectorioBundle:User')->findOneById($sessions);
        $users = $em->getRepository('CleantechDirectorioBundle:User')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users, $request->query->getInt('page',1),
            3
            
            
        );
        
        //$deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'cleantech_user_delete');
        
        return $this->render('CleantechDirectorioBundle:User:users.html.twig', array('users' => $pagination, 'session' => $session));
    }
    
    public function addAction()
    {
        $user = new User();
        $form = $this->createCreateForm($user);
        
        return $this->render('CleantechDirectorioBundle:User:add.html.twig', array('form'=>$form->createView()));
        
    }
    
    public function createCreateForm(User $entity)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $session =  $this -> getUser ();
        
        if($session->getRole() == ('ROLE_ADMIN'))
        {
        $form = $this->createForm(new UserAdminType(), $entity, array(
                'action' => $this->generateUrl('cleantech_user_create'),
                'method' => 'POST'
            ));
            
        return $form;
        }
        
        if($session->getRole() == ('ROLE_SUPER_ADMIN'))
        {
        $form = $this->createForm(new UserSuperAdminType(), $entity, array(
                'action' => $this->generateUrl('cleantech_user_create'),
                'method' => 'POST'
            ));
            
        return $form;
        }
        
    }
    
    public function createAction(Request $request)
    {
        $user = new User();
        $form = $this->createCreateForm($user);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $password = $form->get('password')->getData();
            
            $passwordConstraint = new Assert\NotBlank();
            $errorList = $this->get('validator')->validate($password, $passwordConstraint);
            
            if(count($errorList) == 0)
            {
            
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user,$password);
                
                $user->setPassword($encoded); 
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                $this->addFlash('success','Se ha creado un nuevo usuario.');
                return $this->redirectToRoute('cleantech_user_add');
            }
            else
            {
                $errorMessage = new FormError($errorList[0]->getMessage());
                $form->get('password')->addError($errorMessage);
            }
        }
       
        return $this->render('CleantechDirectorioBundle:User:add.html.twig', array('form'=>$form->createView()));
        
    }
    
    public function editAction($id)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $sessions =  $this -> getUser ();
        
        
      
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CleantechDirectorioBundle:User')->find($id);
        $session = $em->getRepository('CleantechDirectorioBundle:User')->findOneById($sessions);
       
        if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
       
        $form = $this->createdEditForm($user);
       
        if($user->getRole() == ('ROLE_USER') || $session->getEmail() == $user->getEmail() || $session->getRole() == ('ROLE_SUPER_ADMIN') ){ 
            
        return $this->render('CleantechDirectorioBundle:User:edit.html.twig', array('user' => $user, 'form' => $form->createView()));
        }else{
            return $this->redirectToRoute('cleantech_user_usuarios');
        }
    }
    
    
    private function createdEditForm(User $entity)
    {
       
         $form = $this->createForm(new UserType(), $entity, array(
                'action' => $this->generateUrl('cleantech_user_update',
                array('id' => $entity->getId())), 
                'method' => 'PUT'
            ));
        
        return $form;
    }
    
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('CleantechDirectorioBundle:User')->find($id);
        
        if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
        
        $form = $this->createdEditForm($user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $password = $form->get('password')->getData();
            #print_r($password);
            #exit();
            if(!empty ($password))
            {
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $password);
                $user->setPassword($encoded);
            }
            else
            {
                $recoverPass = $this->recoverPass($id);
                $user->setPassword($recoverPass[0]['password']);
            }
            
            if($user->getRole() == 'ROLE_ADMIN')
            {
                $user->setIsActive(1);
            }
            
            $user->setUsername('NULL');
            $user->setRole($user->getRole());
            $em->flush();
            
            $this->addFlash('success','Se han guardado los cambios.');

           return $this->redirectToRoute('cleantech_user_edit', array('id' => $user->getId()));
        }
        
        return $this->render('CleantechDirectorioBundle:User:edit.html.twig', array('user' => $user, 'form' => $form->createView()));   
    }
    
    private function recoverPass($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT u.password
            FROM CleantechDirectorioBundle:User u
            WHERE u.id = :id'
        )->setParameter('id', $id);
        
        $currentPass = $query->getResult();
        
        return $currentPass;
    }
    
    public function viewAction($id)
    {
        
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $sessions =  $this -> getUser ();
        
        
        $repository = $this->getDoctrine()->getRepository('CleantechDirectorioBundle:User');
        $session = $repository->findOneById($sessions);
        $user = $repository->find($id);
        
        if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
        
        $deleteForm = $this->createDeleteForm($user);
        
        return $this->render('CleantechDirectorioBundle:User:view.html.twig', array('user' => $user, 'session' => $session,  'delete_form' => $deleteForm->createView()));  
    }
    
    private function createDeleteForm($user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cleantech_user_delete',array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
    
    public function deleteAction(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();
         $user = $em->getRepository('CleantechDirectorioBundle:User')->find($id);
         
          if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
        
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success','Se ha eliminado el usuario correctamente y su empresa asociada');
            return $this->redirectToRoute('cleantech_user_usuarios');
        }
    }
    
    public function deleteLogicalAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CleantechDirectorioBundle:User')->find($id);
        $email = $user->getEmail();
        
        if (!$user) 
        {
            throw $this->createNotFoundException('User Not Found');
        }
        
        if($user->getRole() == 'ROLE_USER')
        {
            if($user->getIsActive() == 1)
            {
                $user->setIsActive(0);
                 $em->flush();
                 $this->addFlash('alert','Se ha deshabilitado al usuario con el email: '.$email.'.');
        return $this->redirectToRoute('cleantech_user_usuarios');
            }
            
            else if($user->getIsActive() == 0)
            {
                $user->setIsActive(1);
                 $em->flush();
                 
                 $this->addFlash('success','Se habilito al usuario con el email: '.$email.'.');
        return $this->redirectToRoute('cleantech_user_usuarios');
            }
           
        }
        
    }
    
    
    public function buscarUsuarioAction(Request $request)
    {
        
      
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $sessions =  $this -> getUser ();
        
        
        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('CleantechDirectorioBundle:User')->findOneById($sessions);
        $user = $em->getRepository('CleantechDirectorioBundle:User');
        if($request->getMethod()=="POST")
        {
            $buscar = $request->get("buscar");
            $send = $request->get("send");
            
            if($buscar)
            {
            $query = $user->createQueryBuilder('e')
                    ->where('e.email like :nombre')
                    //->where('e.descripcion like :nombre')
                    ->setParameter('nombre', '%'.$buscar.'%')
                    ->getQuery();
                $users = $query->getResult();
                
                 $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users, $request->query->getInt('page',1),
            5
            
            
        );
    
        
        
               
                    return $this->render('CleantechDirectorioBundle:User:users.html.twig', array('users' => $pagination, 'session' => $session));
            
            }
            
            else if($send)
            {

        
        return $this->redirectToRoute('cleantech_user_usuarios');
            }
            
            
        }
        
       
    }
    
    
    
    
    
    public function editPerfilAction()
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
       
        $form = $this->createdEditPerfilForm($datos);
       
        return $this->render('CleantechDirectorioBundle:User:perfil.html.twig', array('dato' => $datos, 'form' => $form->createView()));
        
    }
    
    private function createdEditPerfilForm(User $entity)
    {
        if  ( !$this -> get ( 'security.authorization_checker' ) -> isGranted ( 'IS_AUTHENTICATED_FULLY' ))  
        { 
            throw  $this -> createAccessDeniedException (); 
        }

        $user =  $this -> getUser ();
        
         $form = $this->createForm(new DatoType(), $entity, array(
                'action' => $this->generateUrl('cleantech_user_update_perfil',
                array('id' => $entity->getId())), 
                'method' => 'PUT'
            ));
            
        return $form;
    }
    
    public function updatePerfilAction(Request $request)
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
        
        $form = $this->createdEditPerfilForm($datos);
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
            
            
            $datos->setRole($datos->getRole());
            $datos->setIsActive(1);
            $em->flush();
            
            $this->addFlash('success','Se han actualizado sus datos.');
            return $this->redirectToRoute('cleantech_user_edit_perfil', array('id' => $datos->getId()));
        }
        
        return $this->render('CleantechDirectorioBundle:User:perfil.html.twig', array('dato' => $datos, 'form' => $form->createView()));   
    }
    
    public function manualAction()
    {
       
        return $this->render('CleantechDirectorioBundle:Directorio:manualAdmin.html.twig');
    }
    
}
