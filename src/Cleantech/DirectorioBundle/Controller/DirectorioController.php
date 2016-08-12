<?php

namespace Cleantech\DirectorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Cleantech\DirectorioBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class DirectorioController extends Controller
{
    
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
       
       
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->findAll();
    
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $empresa, $request->query->getInt('page',1),
            3
            
            
        );
        
        
        
        return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));
       // return $this->render('CleantechDirectorioBundle:Directorio:index.html.twig');
       
       
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
                
                 $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $datos, $request->query->getInt('page',1),
            3
            
            
        );
        
               
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            
            }
            
            else if($send)
            {
                
       
            $datos = $em->getRepository('CleantechDirectorioBundle:Empresa')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $datos, $request->query->getInt('page',1),
            3
            
            
        );
        
        //$deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'cleantech_user_delete');
        
         return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));  
            
            }
            
            
        }
        
       
    }
    
    public function directorioVacioAction()
    {
        return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig');
    }
    
    public function modalDetalleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository('CleantechDirectorioBundle:Empresa')->find($id);
        
        if(!$empresa)
        {
            throw $this->createNotFoundException('User Not Found');
        }
       
        return $this->render('CleantechDirectorioBundle:User:Directorio.html.twig', array('detalle' => $empresa));
    }
    
    public function buscarLetraAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository('CleantechDirectorioBundle:Empresa');
        
        if($request->getMethod()=="POST")
        {
            $a = $request->get("a");
            $b = $request->get("b");
            $c = $request->get("c");
            $d = $request->get("d");
            $e = $request->get("e");
            $f = $request->get("f");
            $g = $request->get("g");
            $h = $request->get("h");
            $i = $request->get("i");
            $j = $request->get("j");
            $k = $request->get("k");
            $l = $request->get("l");
            $m = $request->get("m");
            $n = $request->get("n");
            $o = $request->get("o");
            $p = $request->get("p");
            $q = $request->get("q");
            $r = $request->get("r");
            $s = $request->get("s");
            $t = $request->get("t");
            $u = $request->get("u");
            $v = $request->get("v");
            $w = $request->get("w");
            $x = $request->get("x");
            $y = $request->get("y");
            $z = $request->get("z");
            
            //echo "user= ".$user."<br/>"."password= ".$password;exit;
        
            if($a)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'A%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            
            }
            else if($b)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'B%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($c)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'C%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($d)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'D%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($e)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'E%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($f)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'F%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($g)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'G%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($h)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'H%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($i)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'I%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($j)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'J%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($k)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'K%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($l)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'L%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($m)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'M%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($n)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'N%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($o)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'O%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($p)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'P%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($q)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'Q%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($r)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'R%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($s)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'S%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($t)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'T%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($u)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'U%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($v)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'V%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($w)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'W%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($x)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'X%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($y)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'Y%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($z)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.nombre like :nombre')
                    ->setParameter('nombre', 'Z%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            
        }
    }
    
    public function buscarEstadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository('CleantechDirectorioBundle:Empresa');
        
        if($request->getMethod()=="POST")
        {
            $as = $request->get("as");
            $bc = $request->get("bc");
            $bs = $request->get("bs");
            $cc = $request->get("cc");
            $cs = $request->get("cs");
            $ch = $request->get("ch");
            $cl = $request->get("cl");
            $cm = $request->get("cm");
            $cdmx = $request->get("cdmx");
            $dg = $request->get("dg");
            $gt = $request->get("gt");
            $gr = $request->get("gr");
            $hg = $request->get("hg");
            $jc = $request->get("jc");
            $me = $request->get("me");
            $mn = $request->get("mn");
            $ms = $request->get("ms");
            $nt = $request->get("nt");
            $nl = $request->get("nl");
            $oc = $request->get("oc");
            $pl = $request->get("pl");
            $qt = $request->get("qt");
            $qr = $request->get("qr");
            $sp = $request->get("sp");
            $sl = $request->get("sl");
            $sr = $request->get("sr");
            $tc = $request->get("tc");
            $ts = $request->get("ts");
            $tl = $request->get("tl");
            $vz = $request->get("vz");
            $yn = $request->get("yn");
            $zs = $request->get("zs");
            
            //echo "user= ".$user."<br/>"."password= ".$password;exit;
        
            if($as)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Aguascalientes%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            
            }
            else if($bc)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Baja California%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($bs)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Baja California Sur%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($cc)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Campeche%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($cs)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Chiapas%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($ch)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Chihuahua%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($cl)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Coahuila%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($cm)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Colima%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($cdmx)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Ciudad de México%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($dg)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Durango%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($gt)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Guanajuato%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($gr)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Guerrero%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($hg)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Hidalgo%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($jc)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Jalisco%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($me)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Estado de México%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($mn)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Michoacán%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($ms)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Morelos%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($nt)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Nayarit%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($nl)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Nuevo León%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($oc)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Oaxaca%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($pl)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Puebla%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($qt)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Querétaro%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($qr)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Quinatan Roo%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($sp)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'San Luis Potosi%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($sl)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Sinaloa%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($sr)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Sonora%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($tc)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Tabasco%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($ts)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Tamaulipas%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($tl)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Tlaxcala%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($vz)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Veracruz%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($yn)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Yucatán%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            else if($zs)
            {
                $query = $empresas->createQueryBuilder('e')
                    ->where('e.estado like :estado')
                    ->setParameter('estado', 'Zacatecas%')
                    ->getQuery();
                $empresa = $query->getResult();
                
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $empresa, $request->query->getInt('page',1),
                    2
                );
                    return $this->render('CleantechDirectorioBundle:Directorio:directorio.html.twig', array('pagination' => $pagination));    
            }
            
        }
        
    }
    
    
    
    

}
