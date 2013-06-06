<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\TipoAccion;
use UNAH\SGOBundle\Form\TipoAccionType;

/**
 * TipoAccion controller.
 *
 */
class TipoAccionController extends Controller
{
    /**
     * Lists all TipoAccion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:TipoAccion')->findAll();

        return $this->render('UNAHSGOBundle:TipoAccion:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new TipoAccion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TipoAccion();
        $form = $this->createForm(new TipoAccionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoaccion_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:TipoAccion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new TipoAccion entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoAccion();
        $form   = $this->createForm(new TipoAccionType(), $entity);

        return $this->render('UNAHSGOBundle:TipoAccion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoAccion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoAccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoAccion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:TipoAccion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TipoAccion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoAccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoAccion entity.');
        }

        $editForm = $this->createForm(new TipoAccionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:TipoAccion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TipoAccion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoAccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoAccion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoAccionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoaccion_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:TipoAccion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoAccion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:TipoAccion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoAccion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipoaccion'));
    }

    /**
     * Creates a form to delete a TipoAccion entity by id.
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
