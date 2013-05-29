<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use UNAH\SGOBundle\Entity\Comentario;
use UNAH\SGOBundle\Form\ComentarioType;

/**
 * Comentario controller.
 *
 */
class ComentarioController extends Controller
{
    /**
     * Lists all Comentario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Comentario')->findAll();

        return $this->render('UNAHSGOBundle:Comentario:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Comentario entity.
     *
     */
    public function createAction(Request $request, $documento)
    {
        $entity  = new Comentario();
        $form = $this->createForm(new ComentarioType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
		    
			$documento = $em->getRepository('UNAHSGOBundle:Documento')->find($documento);
			$entity->setDocumento($documento);
            
            // Actualizar Comentario anterior
            $old = $documento->getComentarios()->last();
            if($old){
                $old->setFinalizado($entity->getFecha());
                $em->persist($old);
            }
            
            $em->persist($documento);
			$em->persist($entity);
            $em->flush();
			
            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getDocumento()->getId())));
        }
        
        return $this->render('UNAHSGOBundle:Comentario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to create a new Comentario entity.
     *
     */
    public function newAction($documento)
    {
        $entity = new Comentario();
		
        $em = $this->getDoctrine()->getManager();
		
        $documento = $em->getRepository('UNAHSGOBundle:Documento')->find($documento);
		
        if (!$documento) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
		$entity->setDocumento($documento);
        $entity->setUsuario($this->getUser()->getUsername());
		
        $form   = $this->createForm(new ComentarioType(), $entity);
		
        return $this->render('UNAHSGOBundle:Comentario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'documento' => $documento,
        ));
    }
    
    /**
     * Finds and displays a Comentario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $entity = $em->getRepository('UNAHSGOBundle:Comentario')->find($id);
		
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }
		
        $deleteForm = $this->createDeleteForm($id);
		
        return $this->render('UNAHSGOBundle:Comentario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
    /**
     * Displays a form to edit an existing Comentario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $entity = $em->getRepository('UNAHSGOBundle:Comentario')->find($id);
		
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }
		
        $editForm = $this->createForm(new ComentarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		
        return $this->render('UNAHSGOBundle:Comentario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Edits an existing Comentario entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $entity = $em->getRepository('UNAHSGOBundle:Comentario')->find($id);
		
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }
		
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ComentarioType(), $entity);
        $editForm->bind($request);
		
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
		
            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getDocumento()->getId())));
        }
		
        return $this->render('UNAHSGOBundle:Comentario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Comentario entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Comentario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comentario entity.');
            }
			
			$documento = $entity->getDocumento();
			
            $em->remove($entity);
            $em->flush();
			
            return $this->redirect($this->generateUrl('documento_show', array('id' => $documento->getId())));
        }
		
        return $this->redirect($this->generateUrl('comentario'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/estadistica/resumen", name="comentario_estadisticas")
    * @Method("GET")
    * @Template()
    */
    public function estadisticasAction(Request $request) {
        $form = $this->createDateSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $qb = $em->createQueryBuilder();
            $query = $qb->select('AVG(c.tiempo) as tiempo, count(c) as cantidad, c.usuario')
                ->from('UNAH\SGOBundle\Entity\Comentario', 'c')
                ->where($qb->expr()->between('c.fecha', ':inicio', ':fin'))
                ->groupBy('c.usuario')
                ->setParameter('inicio', $form->get('inicio_comentario')->getData())
                ->setParameter('fin', $form->get('fin_comentario')->getData())
                ->getQuery();
            
            $tiempo = $query->getResult();
            
            return array(
                'tiempo' => $tiempo,
                'inicio' => $form->get('inicio_comentario')->getData(),
                'fin' => $form->get('fin_comentario')->getData(),
            );
        }
        return $this->redirect($this->generateUrl('documento'));
    }
    
    /**
     * Creates a form to delete a Comentario entity by id.
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
    
    private function createDateSearchForm()
    {
        return $this->createFormBuilder()
        ->add('inicio_comentario', 'date', array(
                    'label' => 'Fecha Inicial',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->add('fin_comentario', 'date', array(
                    'label' => 'Fecha Final',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->getForm();
    }
}
