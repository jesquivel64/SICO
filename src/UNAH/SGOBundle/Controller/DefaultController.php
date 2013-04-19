<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAH\SGOBundle\Entity\Oficio;
use UNAH\SGOBundle\Form\OficioType;
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
        $entity = new Oficio();
        $form   = $this->createForm(new OficioType(), $entity);
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Oficio')->findAll();

        return array(
            'form'   => $form->createView(),
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
