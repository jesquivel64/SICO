<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Centro;
use UNAH\SGOBundle\Form\CentroType;

/**
 * Centro controller.
 *
 */
class CentroController extends Controller
{
    /**
     * Lists all Centro entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Centro')->findAll();

        return $this->render('UNAHSGOBundle:Centro:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Centro entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Centro();
        $form = $this->createForm(new CentroType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centro_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:Centro:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Centro entity.
     *
     */
    public function newAction()
    {
        $entity = new Centro();
        $form   = $this->createForm(new CentroType(), $entity);

        return $this->render('UNAHSGOBundle:Centro:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Centro entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Centro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Centro:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Centro entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Centro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centro entity.');
        }

        $editForm = $this->createForm(new CentroType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Centro:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Centro entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Centro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CentroType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centro_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:Centro:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Centro entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Centro')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Centro entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('centro'));
    }

    /**
     * Creates a form to delete a Centro entity by id.
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
