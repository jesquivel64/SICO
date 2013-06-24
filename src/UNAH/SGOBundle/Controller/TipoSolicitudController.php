<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\TipoSolicitud;
use UNAH\SGOBundle\Entity\Coordinacion;
use UNAH\SGOBundle\Form\TipoSolicitudType;

/**
 * TipoSolicitud controller.
 *
 */
class TipoSolicitudController extends Controller
{
    /**
     * Lists all TipoSolicitud entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:TipoSolicitud')->findAll();

        return $this->render('UNAHSGOBundle:TipoSolicitud:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    public function coordinacionAction($coordinacion)
    {
        $em = $this->getDoctrine()->getManager();
        $coordinacion = $em->getRepository('UNAHSGOBundle:Coordinacion')->find($coordinacion);
        
        $serializer = $this->container->get('jms_serializer');
        return new Response($serializer->serialize($coordinacion->getSolicitudes(), 'json'));
    }

    /**
     * Creates a new TipoSolicitud entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TipoSolicitud();
        $form = $this->createForm(new TipoSolicitudType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposolicitud_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:TipoSolicitud:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new TipoSolicitud entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoSolicitud();
        $form   = $this->createForm(new TipoSolicitudType(), $entity);

        return $this->render('UNAHSGOBundle:TipoSolicitud:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoSolicitud entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoSolicitud')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoSolicitud entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:TipoSolicitud:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TipoSolicitud entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoSolicitud')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoSolicitud entity.');
        }

        $editForm = $this->createForm(new TipoSolicitudType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:TipoSolicitud:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TipoSolicitud entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:TipoSolicitud')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoSolicitud entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoSolicitudType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposolicitud_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:TipoSolicitud:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoSolicitud entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:TipoSolicitud')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoSolicitud entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tiposolicitud'));
    }

    /**
     * Creates a form to delete a TipoSolicitud entity by id.
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
