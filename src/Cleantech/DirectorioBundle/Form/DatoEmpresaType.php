<?php

namespace Cleantech\DirectorioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class DatoEmpresaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('ramaTecnologica','choice',array('choices' => array('Agua' => 'Agua', 
                                                                        'Captura y Reducción de Gases de Efecto Invernadero' => 'Captura y Reducción de Gases de Efecto Invernadero', 
                                                                        'Combustibles' => 'Combustibles', 
                                                                        'Conservación de Recursos Naturales y Agrícolas' => 'Conservación de Recursos Naturales y Agrícolas', 
                                                                        'Construcción Verde' => 'Construcción Verde',
                                                                        'Eficiencia Energética' => 'Eficiencia Energética',
                                                                        'Generación de Energía' => 'Generación de Energía',
                                                                        'Materiales y Componentes' => 'Materiales y Componentes',
                                                                        'Residuos Sólidos' => 'Residuos Sólidos',
                                                                        'Tecnologías de la Información' => 'Tecnologías de la Información',
                                                                        'Transporte y Movilidad' => 'Transporte y Movilidad',
                                                                        'Otra' => 'Otra'), 'placeholder' => 'Selecciona una Tecnológia'))
            ->add('industria','choice',array('choices' => array('Agricultura, aprovechamiento forestal y recursos naturales' => 'Agricultura, aprovechamiento forestal y recursos naturales',
                                                                'Captación, tratamiento y suministro de agua' => 'Captación, tratamiento y suministro de agua',
                                                                'Construcción' => 'Construcción',
                                                                'Consumo masivo' => 'Consumo masivo',
                                                                'Energía' => 'Energía',
                                                                'Industria Química' => 'Industria Química',
                                                                'Transportes' => 'Transportes'), 'placeholder' => 'Selecciona una Industria'))
            ->add('rSocial')
            ->add('calle')
            ->add('colonia')
            ->add('rfc')
            ->add('cp')
            ->add('municipio')
            ->add('facebook')
            ->add('linkedin')
            ->add('twitter')
            ->add('web')
            ->add('estado','choice',array('choices' => array('Aguascalientes' => 'Aguascalientes', 'Baja California' => 'Baja California', 'Baja California Sur' => 'Baja California Sur', 'Campeche' => 'Campeche', 'Chiapas' => 'Chiapas', 'Chihuahua' => 'Chihuahua', 'Coahuila' => 'Coahuila', 'Colima' => 'Colima', 'Ciudad de México' => 'Ciudad de México', 'Durango' => 'Durango', 'Guanajuato' => 'Guanajuato', 'Guerrero' => 'Guerrero', 'Hidalgo' => 'Hidalgo', 'Jalisco' => 'Jalisco', 'Estado de México' => 'Estado de México', 'Michoacán' => 'Michoacán', 'Morelos' => 'Morelos', 'Nayarit' => 'Nayarit', 'Nuevo León' => 'Nuevo León', 'Oaxaca' => 'Oaxaca', 'Puebla' => 'Puebla', 'Querétaro' => 'Querétaro', 'Quintana Roo' => 'Quintana Roo', 'San Luis Potosí' => 'San Luis Potosí', 'Sinaloa' => 'Sinaloa', 'Sonora' => 'Sonora', 'Tabasco' => 'Tabasco', 'Tamaulipas' => 'Tamaulipas', 'Tlaxcala' => 'Tlaxcala', 'Veracruz' => 'Veracruz', 'Yucatán' => 'Yucatán', 'Zacatecas' => 'Zacatecas'), 'placeholder' => 'Selecciona un estado'))
            ->add('telefono')
            ->add('servicio','choice',array('choices' => array('Doméstico' => 'Doméstico', 'Industrial' => 'Industrial'), 'placeholder' => 'Selecciona un Servicio'))
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
