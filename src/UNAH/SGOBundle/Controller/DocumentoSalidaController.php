<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\DocumentoSalida;
use UNAH\SGOBundle\Form\DocumentoSalidaType;

/**
 * DocumentoSalida controller.
 *
 */
class DocumentoSalidaController extends Controller
{
    /**
     * Lists all DocumentoSalida entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->findAll();

        return $this->render('UNAHSGOBundle:DocumentoSalida:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new DocumentoSalida entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new DocumentoSalida();
        $form = $this->createForm(new DocumentoSalidaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('salida_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:DocumentoSalida:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new DocumentoSalida entity.
     *
     */
    public function newAction()
    {
        $entity = new DocumentoSalida();
        $form   = $this->createForm(new DocumentoSalidaType(), $entity);

        return $this->render('UNAHSGOBundle:DocumentoSalida:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DocumentoSalida entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocumentoSalida entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:DocumentoSalida:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing DocumentoSalida entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocumentoSalida entity.');
        }

        $editForm = $this->createForm(new DocumentoSalidaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:DocumentoSalida:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing DocumentoSalida entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocumentoSalida entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DocumentoSalidaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('salida_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:DocumentoSalida:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DocumentoSalida entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:DocumentoSalida')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DocumentoSalida entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('salida'));
    }

    /**
     * Creates a form to delete a DocumentoSalida entity by id.
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
