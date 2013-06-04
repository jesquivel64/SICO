<?php

namespace UNAH\SGOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use UNAH\SGOBundle\Entity\Departamento;

class TipoDocumentoRecibidoType extends DocumentoRecibidoType
{
    public function __construct($tipoDepartamento)
    {
        $this->tipoDepartamento = $tipoDepartamento;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $tipoDepartamento = $this->tipoDepartamento;
        $builder
            ->add('emisor', null, array(
                'required' => false,
                'attr' => array('size' => 20),
                'query_builder' => function(EntityRepository $er) use ($tipoDepartamento)
                {
                    return $er->createQueryBuilder('d')
                        ->where('d.tipoDepartamento = :tipoDepartamento')
                        ->setParameter('tipoDepartamento', $tipoDepartamento)
                    ;
                }
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
        return 'unah_sgobundle_tipodocumentoenviadotype';
    }
}
