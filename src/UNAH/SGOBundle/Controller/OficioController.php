<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAH\SGOBundle\Entity\Oficio;
use UNAH\SGOBundle\Form\OficioType;

/**
 * Oficio controller.
 *
 * @Route("/oficio")
 */
class OficioController extends Controller
{
    /**
     * Lists all Oficio entities.
     *
     * @Route("/", name="oficio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Oficio')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Oficio entity.
     *
     * @Route("/", name="oficio_create")
     * @Method("POST")
     * @Template("UNAHSGOBundle:Oficio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Oficio();
        $form = $this->createForm(new OficioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oficio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Oficio entity.
     *
     * @Route("/new", name="oficio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Oficio();
        $form   = $this->createForm(new OficioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Oficio entity.
     *
     * @Route("/{id}", name="oficio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Oficio entity.
     *
     * @Route("/{id}/edit", name="oficio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }

        $editForm = $this->createForm(new OficioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Oficio entity.
     *
     * @Route("/{id}", name="oficio_update")
     * @Method("PUT")
     * @Template("UNAHSGOBundle:Oficio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oficio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OficioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oficio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Oficio entity.
     *
     * @Route("/{id}", name="oficio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Oficio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Oficio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('oficio'));
    }

    /**
     * Creates a form to delete a Oficio entity by id.
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
