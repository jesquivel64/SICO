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
            ->add('tipo')
            ->add('numero')
            ->add('descripcion')
            ->add('autor')
            ->add('entregado')
            ->add('destinatario')
            ->add('recibio')
            ->add('fechaDeEmision')
            ->add('fechaDeEnvio')
            ->add('fechaDeRecibido')
            ->add('estado')
            ->add('receptores')
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
