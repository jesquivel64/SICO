<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Accion;
use UNAH\SGOBundle\Form\AccionType;
use UNAH\SGOBundle\Entity\Comentario;

/**
 * Accion controller.
 *
 */
class AccionController extends Controller
{
    /**
     * Lists all Accion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Accion')->findAll();

        return $this->render('UNAHSGOBundle:Accion:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Accion entity.
     *
     */
    public function createAction(Request $request, $documento)
    {
        $entity  = new Accion();
        $form = $this->createForm(new AccionType(), $entity);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
        
        $documento = $em->getRepository('UNAHSGOBundle:Documento')->find($documento);
        
        if ($form->isValid()) {
            
            $entity->setDocumento($documento);
            $em->persist($entity);
            
            $comentario = new Comentario();
            $comentario->setUsuario($this->getUser()->getUsername());
            $comentario->setFecha($entity->getFecha());
            $comentario->setComentario($entity->getTipo()->getNombre().": ".$entity->getDescripcion());
            $comentario->setDocumento($documento);
            $comentario->setEditable(FALSE);
            $em->persist($comentario);
            
            $documento->addComentario($comentario);
            $documento->addAccione($entity);
            $documento->setClasificar(FALSE);
            
            $em->persist($documento);
            
            $em->flush();
            
            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getDocumento()->getId())));
        }
        
        return $this->render('UNAHSGOBundle:Accion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'documento' => $documento,
        ));
    }

    /**
     * Displays a form to create a new Accion entity.
     *
     */
    public function newAction($documento)
    {
        $entity  = new Accion();
        $em = $this->getDoctrine()->getManager();
        
        $documento = $em->getRepository('UNAHSGOBundle:Documento')->find($documento);
        
        if (!$documento) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        $entity->setDocumento($documento);
        
        $form   = $this->createForm(new AccionType(), $entity);

        return $this->render('UNAHSGOBundle:Accion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'documento' => $documento,
        ));
    }

    /**
     * Finds and displays a Accion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Accion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Accion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Accion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Accion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accion entity.');
        }

        $editForm = $this->createForm(new AccionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Accion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Accion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Accion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AccionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('accion_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:Accion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Accion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Accion')->find($id);
            
            $documento = $entity->getDocumento();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Accion entity.');
            }
            $entity->removeUpload();
            $em->remove($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('documento_show', array('id' => $documento->getId())));
        }
        return $this->redirect($this->generateUrl('accion'));
    }

    /**
     * Creates a form to delete a Accion entity by id.
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
