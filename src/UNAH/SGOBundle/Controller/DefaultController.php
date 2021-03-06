<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAH\SGOBundle\Form\DepartamentoType;

class DefaultController extends Controller
{
	/**
     * Lists all Oficio entities.
     *
     * @Route("/", name="oficio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository('UNAHSGOBundle:TipoDocumento')->findAll();
        $coordinaciones = $em->getRepository('UNAHSGOBundle:Coordinacion')->findAll();
        return array(
            'tipos' => $tipos,
            'coordinaciones' => $coordinaciones,
        );
    }
    /**
     * Lists all Oficio entities.
     *
     * @Route("/", name="oficio")
     * @Method("GET")
     * @Template()
     */
    public function helpAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository('UNAHSGOBundle:TipoDocumento')->findAll();
        $coordinaciones = $em->getRepository('UNAHSGOBundle:Coordinacion')->findAll();
        return array(
            'tipos' => $tipos,
            'coordinaciones' => $coordinaciones,
        );
    }
    
    /**
     * Lists all Oficio entities.
     *
     * @Route("/", name="oficio")
     * @Method("GET")
     * @Template()
     */
     public function clasificarAction()
     {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        
        $query = $qb->select('d')
            ->from('UNAH\SGOBundle\Entity\Documento', 'd')
            ->where('d.recibido = :recibido')
            ->andWhere('d.clasificar = :clasificar')
            ->setParameter('recibido', TRUE)
            ->setParameter('clasificar', TRUE)
            ->orderBy('d.id', 'DESC')
            ->getQuery();
         
         $documentos = $query->getResult();
         return array(
            'documentos' => $documentos,
         );
     }
	
	private function createDateSearchForm()
	{
		return $this->createFormBuilder()
		->add('inicio', 'date', array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy',
				'attr' => array('class' => 'datepicker')))
		->add('fin', 'date', array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy',
				'attr' => array('class' => 'datepicker')))
		->getForm();
	}
	
	private function createNumeroSearchForm()
	{
		return $this->createFormBuilder()
		->add('numero')
		->getForm();
	}
    
    private function createEmisionSearchForm()
    {
        return $this->createFormBuilder()
        ->add('inicio_emision', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker')))
        ->add('fin_emision', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker')))
        ->getForm();
    }
	
	private function createDepartamentoSearchForm()
	{
		return $this->createFormBuilder()
		->add('emisor', 'entity', array(
			'class' => 'UNAH\SGOBundle\Entity\Departamento'
			)
		)
		->getForm();
	}
}
