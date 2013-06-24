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
            ->add('numero', null, array(
                    'label' => 'Número',
                    'attr' => array('placeholder' => 'VRI-1234-2013')))
            ->add('copia', null, array(
                    'label' => 'Es Copia',
                    'required'  => FALSE
                    ))
            ->add('instancia', null, array(
                    'label' => 'Instancia',
                    'empty_data'  => null,
                    'empty_value' => "",
                    'attr' => array('class' => 'chosen-select')))
            ->add('centro', null, array(
                    'label' => 'Centro',
                    'empty_data'  => null,
                    'empty_value' => "",
                    'attr' => array('class' => 'chosen-select')))
            ->add('facultad', null, array(
                    'label' => 'Facultad',
                    'empty_data'  => null,
                    'empty_value' => "",
                    'attr' => array('class' => 'chosen-select')))
            ->add('carrera', null, array(
                    'label' => 'Carrera',
                    'empty_data'  => null,
                    'empty_value' => "",
                    'attr' => array('class' => 'chosen-select')))
            ->add('fecha_de_emision', 'date', array(
                    'label' => 'Fecha de Emisión',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
            ->add('fecha_de_recibido', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy HH:mm',
                    'attr' => array('class' => 'datetimepicker')))
            ->add('recibio', null, array('label' => 'Recibido por'))
            ->add('destinatario')
            ->add('descripcion', 'textarea', array(
                    'label' => 'Descripción',
                    'attr' => array('rows' => 10)))
            ->add("autor", null, array('label' => 'Remitente'))
            ->add('responder', null, array(
                    'label' => 'Requiere Respuesta',
                    'required'  => FALSE
                    ))
            ->add('coordinacion', null, array(
                    'label' => 'Coordinación',
                    'required'  => TRUE
            ))
            ->add('tipoSolicitud', null, array(
                    'label' => 'Tipo de Solicitud',
                    'required'  => TRUE
            ))
            ->add('clasificar', null, array(
                    'label' => 'Requiere curso de Acción Inmediato',
                    'required'  => FALSE
                    ))
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
