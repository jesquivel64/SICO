<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoRespuestaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('descripcion', 'textarea')
            ->add("autor", null, array('label' => 'Remitente'))
            ->add('destinatario', null, array('required' => false))
            ->add('fecha_de_emision', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
            ->add('receptores', null, array('required' => false))
            ->add('receptores')
            ->add('tipo')
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
        return 'unah_sgobundle_documentorespuestatype';
    }
}
