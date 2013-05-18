<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNAH\SGOBundle\Entity\Documento;
use UNAH\SGOBundle\Form\DocumentoType;
use UNAH\SGOBundle\Form\DocumentoRecibidoType;
use UNAH\SGOBundle\Form\DocumentoEnviadoType;

/**
 * Documento controller.
 *
 */
class DocumentoController extends Controller
{
    /**
     * Lists all Documento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAHSGOBundle:Documento')->findAll();

        return $this->render('UNAHSGOBundle:Documento:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Documento entity.
     *
     */
    public function createAction(Request $request, $tipo)
    {
        $entity  = new Documento();
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        $form = $this->createForm(new DocumentoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setTipo($tipo);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:Documento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function recibiendoAction($tipo)
    {
        $entity = new Documento();
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);

        if (!$tipo) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }
        
        $form = $this->createForm(new DocumentoRecibidoType(), $entity);
        
        return $this->render('UNAHSGOBundle:Documento:recibir.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'tipo'   => $tipo,
        ));
    }

    /**
     * Creates a new Documento entity.
     *
     */
    public function recibirAction(Request $request, $tipo)
    {
        $entity  = new Documento();
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        $form = $this->createForm(new DocumentoRecibidoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            
            $entity->setTipo($tipo);
            $entity->setRecibido(TRUE);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:Documento:recibir.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function enviandoAction($tipo)
    {
        $entity = new Documento();
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);

        if (!$tipo) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }
        
        $form = $this->createForm(new DocumentoEnviadoType(), $entity);
        
        return $this->render('UNAHSGOBundle:Documento:enviar.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'tipo'   => $tipo,
        ));
    }

    /**
     * Creates a new Documento entity.
     *
     */
    public function enviarAction(Request $request, $tipo)
    {
        $entity  = new Documento();
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        $form = $this->createForm(new DocumentoEnviadoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            
            $entity->setTipo($tipo);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        }

        return $this->render('UNAHSGOBundle:Documento:enviar.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'tipo'   => $tipo,
        ));
    }

    /**
     * Displays a form to create a new Documento entity.
     *
     */
    public function newAction()
    {
        $entity = new Documento();
        $form   = $this->createForm(new DocumentoType(), $entity);

        return $this->render('UNAHSGOBundle:Documento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Documento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Documento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Documento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }

        $editForm = $this->createForm(new DocumentoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNAHSGOBundle:Documento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Documento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DocumentoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documento_edit', array('id' => $id)));
        }

        return $this->render('UNAHSGOBundle:Documento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Documento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Documento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('documento'));
    }

    /**
     * Creates a form to delete a Documento entity by id.
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
