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

/**
 * Oficio controller.
 *
 * @Route("/oficio")
 */
class OficioController extends Controller
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
		$dateForm = $this->createDateSearchForm();
        $numeroForm = $this->createNumeroSearchForm();
        $deptoForm = $this->createDepartamentoSearchForm();
        $emisionForm = $this->createEmisionSearchForm();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('o')
			->from('UNAH\SGOBundle\Entity\Oficio', 'o')
			->setMaxResults(10)
			->orderBy('o.id', 'DESC')
			->getQuery();

        $entities = $query->getResult();

        return array(
            'entities'      => $entities,
			'date_form'     => $dateForm->createView(),
			'emision_form'  => $emisionForm->createView(),
			'numero_form'   => $numeroForm->createView(),
			'depto_form'    => $deptoForm->createView(),
        );
    }
	
	/**
     * Lists all Oficio entities.
     *
     * @Route("/", name="oficio")
     * @Method("GET")
     * @Template()
     */
    public function searchAction()
    {
		$dateForm = $this->createDateSearchForm();
        $numeroForm = $this->createNumeroSearchForm();
        $deptoForm = $this->createDepartamentoSearchForm();
        $emisionForm = $this->createEmisionSearchForm();
        $comentarioForm = $this->createDepartamentoComentarioSearchForm();

        return array(
			'date_form' => $dateForm->createView(),
			'emision_form' => $emisionForm->createView(),
			'numero_form' => $numeroForm->createView(),
			'depto_form' => $deptoForm->createView(),
			'comentario_form' => $comentarioForm->createView(),
        );
    }

    /**
     * Creates a new Oficio entity.
     *
     * @Route("/", name="oficio_create")
     * @Method("POST")
     * @Template("UNAHSGOBundle:Oficio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Oficio();
        $form = $this->createForm(new OficioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oficio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Oficio entity.
     *
     * @Route("/new", name="oficio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Oficio();
        $entity->setRecibio($this->getUser()->getUsername());
        $form = $this->createForm(new OficioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Oficio entity.
     *
     * @Route("/{id}", name="oficio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }
		
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Oficio entity.
     *
     * @Route("/{id}/edit", name="oficio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }

        $editForm = $this->createForm(new OficioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Oficio entity.
     *
     * @Route("/{id}", name="oficio_update")
     * @Method("PUT")
     * @Template("UNAHSGOBundle:Oficio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OficioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('oficio'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Oficio entity.
     *
     * @Route("/{id}", name="oficio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Oficio entity.');
            }
            foreach ($entity->getAdjuntos() as $adjunto) {
                $em->remove($adjunto);
            }
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('oficio'));
    }

    /**
     * Permite Efectuar busquedas por fecha
     *
     * @Route("/fecha", name="oficio_search_fecha")
     * @Method("GET")
     * @Template()
     */
	public function searchDateAction(Request $request)
	{
		$form = $this->createDateSearchForm();
		$form->bind($request);
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			
			$qb = $em->createQueryBuilder();
			$query = $qb->select('o')
				->from('UNAH\SGOBundle\Entity\Oficio', 'o')
				->where($qb->expr()->between('o.fecha_de_recibido', ':inicio', ':fin'))
				->setParameter('inicio', $form->get('inicio')->getData())
				->setParameter('fin', $form->get('fin')->getData())
				->getQuery();
			
			$oficios = $query->getResult();
			$query = $qb->select('count(o)')
				->where($qb->expr()->between('o.fecha_de_recibido', ':inicio', ':fin'))
				->setParameter('inicio', $form->get('inicio')->getData())
				->setParameter('fin', $form->get('fin')->getData())
				->getQuery();
			$count = $query->getSingleScalarResult();

			return array(
				'oficios'   => $oficios,
				'inicio'    => $form->get('inicio')->getData(),
				'fin'       => $form->get('fin')->getData(),
				'date_form' => $form->createView(),
				'count'     => $count,
			);
		}
        return $this->redirect($this->generateUrl('oficio'));
	}

    /**
     * Permite Efectuar busquedas por fecha
     *
     * @Route("/emitido", name="oficio_search_emitido")
     * @Method("GET")
     * @Template()
     */
	public function searchEmisionAction(Request $request)
	{
		$form = $this->createEmisionSearchForm();
		$form->bind($request);
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			
			$qb = $em->createQueryBuilder();
			$query = $qb->select('o')
				->from('UNAH\SGOBundle\Entity\Oficio', 'o')
				->where($qb->expr()->between('o.fecha_de_emision', ':inicio', ':fin'))
				->setParameter('inicio', $form->get('inicio_emision')->getData())
				->setParameter('fin', $form->get('fin_emision')->getData())
				->getQuery();
			
			$oficios = $query->getResult();
			$query = $qb->select('count(o)')
				->where($qb->expr()->between('o.fecha_de_emision', ':inicio', ':fin'))
                ->setParameter('inicio', $form->get('inicio_emision')->getData())
                ->setParameter('fin', $form->get('fin_emision')->getData())
				->getQuery();
			$count = $query->getSingleScalarResult();

			return array(
				'oficios'   => $oficios,
				'inicio'    => $form->get('inicio_emision')->getData(),
				'fin'       => $form->get('fin_emision')->getData(),
				'date_form' => $form->createView(),
				'count'     => $count,
			);
		}
        return $this->redirect($this->generateUrl('oficio'));
	}

    /**
     * Permite Efectuar busquedas por fecha
     *
     * @Route("/fecha", name="oficio_search_numero")
     * @Method("GET")
     * @Template()
     */
	public function searchNumeroAction(Request $request)
	{
		$form = $this->createNumeroSearchForm();
		$form->bind($request);
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			
			$qb = $em->createQueryBuilder();
			$query = $qb->select('o')
				->from('UNAH\SGOBundle\Entity\Oficio', 'o')
				->where('o.numero = :numero')
				->setParameter('numero', $form->get('numero')->getData())
				->getQuery();
			
			$oficios = $query->getResult();
			$query = $qb->select('count(o)')
				->where('o.numero = :numero')
				->setParameter('numero', $form->get('numero')->getData())
				->getQuery();
			$count = $query->getSingleScalarResult();

			return array(
				'oficios'       => $oficios,
				'numero'        => $form->get('numero')->getData(),
				'numero_form'   => $form->createView(),
				'count'         => $count,
			);
		}
        return $this->redirect($this->generateUrl('oficio'));
	}

    /**
     * Permite Efectuar busquedas por fecha
     *
     * @Route("/fecha", name="oficio_search_numero")
     * @Method("GET")
     * @Template()
     */
	public function searchDepartamentoComentarioAction(Request $request)
	{
		$form = $this->createDepartamentoComentarioSearchForm();
		$form->bind($request);
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			
			$qb = $em->createQueryBuilder();
			$query = $qb->select('o')
				->from('UNAH\SGOBundle\Entity\Oficio', 'o')
				->where('o.emisor = :emisor')
                ->andwhere('o.descripcion LIKE :descripcion')
				->setParameter('emisor', $form->get('emisor')->getData())
                ->setParameter('descripcion', "%".$form->get('descripcion')->getData()."%")
				->getQuery();
			
			$oficios = $query->getResult();
			$query = $qb->select('count(o)')
                ->where('o.emisor = :emisor')
				->andwhere('o.descripcion LIKE :descripcion')
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->setParameter('descripcion', "%".$form->get('descripcion')->getData()."%")
				->getQuery();
			$count = $query->getSingleScalarResult();

			return array(
				'oficios'       => $oficios,
				'departamento'  => $form->get('emisor')->getData(),
				'descripcion'   => $form->get('descripcion')->getData(),
				'depto_form'    => $form->createView(),
				'count'         => $count,
			);
		}
        return $this->redirect($this->generateUrl('oficio'));
	}

    /**
     * Permite Efectuar busquedas por fecha
     *
     * @Route("/fecha", name="oficio_search_numero")
     * @Method("GET")
     * @Template()
     */
    public function searchDepartamentoAction(Request $request)
    {
        $form = $this->createDepartamentoSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $qb = $em->createQueryBuilder();
            $query = $qb->select('o')
                ->from('UNAH\SGOBundle\Entity\Oficio', 'o')
                ->where('o.emisor = :emisor')
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->getQuery();
            
            $oficios = $query->getResult();
            $query = $qb->select('count(o)')
                ->where('o.emisor = :emisor')
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->getQuery();
            $count = $query->getSingleScalarResult();

            return array(
                'oficios'       => $oficios,
                'departamento'  => $form->get('emisor')->getData(),
                'depto_form'    => $form->createView(),
                'count'         => $count,
            );
        }
        return $this->redirect($this->generateUrl('oficio'));
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
	
	private function createNumeroSearchForm()
	{
		return $this->createFormBuilder()
		->add('numero')
		->getForm();
	}
	
	private function createDepartamentoSearchForm()
	{
		return $this->createFormBuilder()
		->add('emisor', 'entity', array(
			'class' => 'UNAH\SGOBundle\Entity\Departamento',
			)
		)
		->getForm();
	}
    
    private function createDepartamentoComentarioSearchForm()
    {
        return $this->createFormBuilder()
        ->add('descripcion', 'textarea')
        ->add('emisor', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\Departamento',
            )
        )
        ->getForm();
    }

    /**
     * Creates a form to delete a Oficio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
