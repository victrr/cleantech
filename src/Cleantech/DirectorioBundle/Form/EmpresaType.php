<?php

namespace Cleantech\DirectorioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class EmpresaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('user', 'entity', array('class' => 'CleantechDirectorioBundle:User', 'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')
                    ->where('u.role = :only')
                    ->setParameter('only', 'ROLE_USER');
                },
                'choice_label' => 'getFullName'
            ))
            ->add('ramaTecnologica')
            ->add('industria')
            ->add('calle')
            ->add('colonia')
            ->add('calle')
            ->add('estado')
            ->add('telefono')
            ->add('servicio')
            ->add('descripcion')
            ->add('file')
            ->add('save', 'submit', array('label' => 'save empresa'))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cleantech\DirectorioBundle\Entity\Empresa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'empresa';
    }
}
