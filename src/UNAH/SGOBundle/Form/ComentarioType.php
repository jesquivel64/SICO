<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComentarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estado', null, array('label' => 'Enviado a'))
            ->add('comentario', 'textarea', array('label' => 'Descripción'))
            /*->add('oficio', 'entity', array(
				'class' => 'UNAHSGOBundle:Oficio',
			))*/
			->add('usuario')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAH\SGOBundle\Entity\Comentario'
        ));
    }

    public function getName()
    {
        return 'unah_sgobundle_comentariotype';
    }
}
