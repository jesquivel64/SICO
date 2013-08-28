<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Instancia;
use UNAH\SGOBundle\Form\InstanciaType;

/**
 * Instancia controller.
 *
 */
class InstanciaController extends Controller
{
    /**
     * Lists all Instancia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Instancia')->findAll();

        return $this->render('UNAHSGOBundle:Instancia:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Instancia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Instancia();
        $form = $this->createForm(new InstanciaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('instancia_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:Instancia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Instancia entity.
     *
     */
    public function newAction()
    {
        $entity = new Instancia();
        $form   = $this->createForm(new InstanciaType(), $entity);

        return $this->render('UNAHSGOBundle:Instancia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Instancia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Instancia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Instancia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Instancia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Instancia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Instancia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Instancia entity.');
        }

        $editForm = $this->createForm(new InstanciaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Instancia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Instancia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Instancia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Instancia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InstanciaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('instancia_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:Instancia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Instancia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Instancia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Instancia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('instancia'));
    }

    /**
     * Creates a form to delete a Instancia entity by id.
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
