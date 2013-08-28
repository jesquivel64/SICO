<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Carrera;
use UNAH\SGOBundle\Form\CarreraType;

/**
 * Carrera controller.
 *
 */
class CarreraController extends Controller
{
    /**
     * Lists all Carrera entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Carrera')->findAll();

        return $this->render('UNAHSGOBundle:Carrera:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Carrera entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Carrera();
        $form = $this->createForm(new CarreraType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carrera_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:Carrera:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Carrera entity.
     *
     */
    public function newAction()
    {
        $entity = new Carrera();
        $form   = $this->createForm(new CarreraType(), $entity);

        return $this->render('UNAHSGOBundle:Carrera:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Carrera entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Carrera:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Carrera entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $editForm = $this->createForm(new CarreraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Carrera:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Carrera entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CarreraType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carrera_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:Carrera:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Carrera entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Carrera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Carrera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('carrera'));
    }

    /**
     * Creates a form to delete a Carrera entity by id.
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
