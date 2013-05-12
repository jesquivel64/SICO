<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\TipoDocumento;
use UNAH\SGOBundle\Form\TipoDocumentoType;

/**
 * TipoDocumento controller.
 *
 */
class TipoDocumentoController extends Controller
{
    /**
     * Lists all TipoDocumento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:TipoDocumento')->findAll();

        return $this->render('UNAHSGOBundle:TipoDocumento:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new TipoDocumento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TipoDocumento();
        $form = $this->createForm(new TipoDocumentoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipodocumento_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:TipoDocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new TipoDocumento entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoDocumento();
        $form   = $this->createForm(new TipoDocumentoType(), $entity);

        return $this->render('UNAHSGOBundle:TipoDocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoDocumento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:TipoDocumento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TipoDocumento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $editForm = $this->createForm(new TipoDocumentoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:TipoDocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TipoDocumento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoDocumentoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipodocumento_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:TipoDocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoDocumento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipodocumento'));
    }

    /**
     * Creates a form to delete a TipoDocumento entity by id.
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
