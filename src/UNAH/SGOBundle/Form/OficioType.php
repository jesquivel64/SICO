<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OficioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('remitente')
            ->add('destinatario')
            ->add('descripcion', 'textarea')
            ->add('estado', 'textarea')
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
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAH\SGOBundle\Entity\Oficio'
        ));
    }

    public function getName()
    {
        return 'unah_sgobundle_oficiotype';
    }
}
