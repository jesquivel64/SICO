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
            ->add('comentario', 'textarea', array(
                    'label' => 'Descripción',
                    'attr' => array('rows' => 10)))
			->add('usuario')
            ->add('curso', 'checkbox', array(
                    'property_path' => false,
                    'label' => 'Se requiere nuevo curso de accion',
                    'required'  => false
                    ))
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
