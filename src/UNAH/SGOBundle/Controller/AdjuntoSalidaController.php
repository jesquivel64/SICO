<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\AdjuntoSalida;
use UNAH\SGOBundle\Form\AdjuntoSalidaType;

/**
 * AdjuntoSalida controller.
 *
 */
class AdjuntoSalidaController extends Controller
{
    /**
     * Lists all AdjuntoSalida entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:AdjuntoSalida')->findAll();

        return $this->render('UNAHSGOBundle:AdjuntoSalida:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new AdjuntoSalida entity.
     *
     */
    public function createAction(Request $request, $documento)
    {
        $entity  = new AdjuntoSalida();
        $form = $this->createForm(new AdjuntoSalidaType(), $entity);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
        $documento = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->find($documento);

        if ($form->isValid()) {
            
            $entity->setDocumento($documento);
            $entity->upload();
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('salida_show', array('id' => $documento->getId())));
        }

        return $this->render('UNAHSGOBundle:AdjuntoSalida:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'documento' => $documento,
        ));
    }

    /**
     * Displays a form to create a new AdjuntoSalida entity.
     *
     */
    public function newAction($documento)
    {
        $entity = new AdjuntoSalida();
        $form   = $this->createForm(new AdjuntoSalidaType(), $entity);
        $em = $this->getDoctrine()->getManager();
        $documento = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->find($documento);

        return $this->render('UNAHSGOBundle:AdjuntoSalida:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'documento' => $documento,
        ));
    }

    /**
     * Finds and displays a AdjuntoSalida entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:AdjuntoSalida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdjuntoSalida entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:AdjuntoSalida:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AdjuntoSalida entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:AdjuntoSalida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdjuntoSalida entity.');
        }

        $editForm = $this->createForm(new AdjuntoSalidaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:AdjuntoSalida:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'documento' => $entity->getDocumento(),
        ));
    }

    /**
     * Edits an existing AdjuntoSalida entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:AdjuntoSalida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdjuntoSalida entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AdjuntoSalidaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entity->upload();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('salida_show', array('id' => $documento->getId())));
        }

        return $this->render('UNAHSGOBundle:AdjuntoSalida:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AdjuntoSalida entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:AdjuntoSalida')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AdjuntoSalida entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adjuntosalida'));
    }

    /**
     * Creates a form to delete a AdjuntoSalida entity by id.
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
