<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Adjunto;
use UNAH\SGOBundle\Form\AdjuntoType;

/**
 * Adjunto controller.
 *
 */
class AdjuntoController extends Controller
{
    /**
     * Lists all Adjunto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Adjunto')->findAll();

        return $this->render('UNAHSGOBundle:Adjunto:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Adjunto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Adjunto();
        $form = $this->createForm(new AdjuntoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			$entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oficio_show', array('id' => $entity->getOficio()->getId())));
        }

        return $this->render('UNAHSGOBundle:Adjunto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Adjunto entity.
     *
     */
    public function newAction($oficio)
    {
        $entity = new Adjunto();
		
        $em = $this->getDoctrine()->getManager();

        $oficio = $em->getRepository('UNAHSGOBundle:Oficio')->find($oficio);

        if (!$oficio) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }
		$entity->setOficio($oficio);
		
        $form   = $this->createForm(new AdjuntoType(), $entity);

        return $this->render('UNAHSGOBundle:Adjunto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Adjunto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Adjunto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adjunto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Adjunto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Adjunto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Adjunto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adjunto entity.');
        }

        $editForm = $this->createForm(new AdjuntoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Adjunto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Adjunto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Adjunto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adjunto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AdjuntoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adjunto_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:Adjunto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Adjunto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Adjunto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Adjunto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adjunto'));
    }

    /**
     * Creates a form to delete a Adjunto entity by id.
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
