<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Coordinacion;
use UNAH\SGOBundle\Form\CoordinacionType;

/**
 * Coordinacion controller.
 *
 */
class CoordinacionController extends Controller
{
    /**
     * Lists all Coordinacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('UNAHSGOBundle:Coordinacion')->findAll();
        
        return $this->render('UNAHSGOBundle:Coordinacion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Coordinacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Coordinacion();
        $form = $this->createForm(new CoordinacionType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('coordinacion_show', array('id' => $entity->getId())));
        }
        
        return $this->render('UNAHSGOBundle:Coordinacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to create a new Coordinacion entity.
     *
     */
    public function newAction()
    {
        $entity = new Coordinacion();
        $form   = $this->createForm(new CoordinacionType(), $entity);
        
        return $this->render('UNAHSGOBundle:Coordinacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Finds and displays a Coordinacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Coordinacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Coordinacion entity.');
        }
        
        $documentos = $em->getRepository('UNAHSGOBundle:Documento')->findBy(
            array(
                'coordinacion' => $entity->getId(),
                'respondido'   => FALSE,
                'responder'    => TRUE
            )
        );
        
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('UNAHSGOBundle:Coordinacion:show.html.twig', array(
            'entity'      => $entity,
            'documentos'  => $documentos,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Coordinacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Coordinacion')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Coordinacion entity.');
        }
        
        $editForm = $this->createForm(new CoordinacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('UNAHSGOBundle:Coordinacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Edits an existing Coordinacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Coordinacion')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Coordinacion entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CoordinacionType(), $entity);
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('coordinacion_edit', array('id' => $id)));
        }
        
        return $this->render('UNAHSGOBundle:Coordinacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Coordinacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Coordinacion')->find($id);
            
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Coordinacion entity.');
            }
            
            $em->remove($entity);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('coordinacion'));
    }
    
    /**
     * Creates a form to delete a Coordinacion entity by id.
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
