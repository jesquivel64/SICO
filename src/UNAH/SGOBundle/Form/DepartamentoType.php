<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('tipoDepartamento', null, array('label' => 'Tipo de Emisor o Receptor'))
            ->add('color', null, array('attr' => array('class' => 'colorpicker')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAH\SGOBundle\Entity\Departamento'
        ));
    }

    public function getName()
    {
        return 'unah_sgobundle_departamentotype';
    }
}
