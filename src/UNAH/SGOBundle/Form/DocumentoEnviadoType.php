<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoEnviadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', null, array(
                    'label' => 'Número',
                    'attr' => array('placeholder' => 'VRA-1234-2013')))
            ->add('descripcion', 'textarea', array(
                    'label' => 'Descripción',
                    'attr' => array('rows' => 10)))
            ->add("autor", null, array('label' => 'Remitente'))
            ->add('destinatario', null, array('required' => false))
            ->add('fecha_de_emision', 'date', array(
                    'label' => 'Fecha de Emisión',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy HH:mm',
                    'attr' => array('class' => 'datetimepicker')))
            ->add('receptores', null, array(
                    'required' => false,
                    'attr' => array('size' => 20)))
            ->add("respuesta", null, array( "mapped" => false,
                    'required' => false, 'label' => 'En Respuesta a',
                    'attr' => array('placeholder' => 'VRI-1234-2013')))
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
        return 'unah_sgobundle_documentotype';
    }
}
