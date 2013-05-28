<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoRecibidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('autor', null, array('label' => 'Remitente'))
            ->add('destinatario')
            ->add('descripcion', 'textarea')
            ->add('fecha_de_emision', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
            ->add('fecha_de_recibido', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
            ->add('emisor', null, array('label' => 'Dependencia'))
            ->add('recibio')
            ->add('responder', null, array('label' => 'Requiere Respuesta'))
            ->add('tipoSolicitud', null, array('label' => 'Tipo de Solicitud'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAH\SGOBundle\Entity\Documento'
        ));
    }

    public function getName()
    {
        return 'unah_sgobundle_documentorecibidotype';
    }
}
