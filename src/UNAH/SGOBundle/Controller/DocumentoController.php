<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use UNAH\SGOBundle\Entity\Documento;
use UNAH\SGOBundle\Entity\Comentario;
use UNAH\SGOBundle\Entity\TipoSolicitud;
use UNAH\SGOBundle\Entity\Departamento;
use UNAH\SGOBundle\Form\DocumentoType;
use UNAH\SGOBundle\Form\DepartamentoType;
use UNAH\SGOBundle\Form\TipoSolicitudType;
use UNAH\SGOBundle\Form\DocumentoEnviadoType;
use UNAH\SGOBundle\Form\DocumentoRecibidoType;
use UNAH\SGOBundle\Form\DocumentoRespuestaType;
use UNAH\SGOBundle\Form\TipoDocumentoEnviadoType;

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
        $periodo_tipo_form = $this->createDateSearchForm();
        $periodo_form = $this->createPeriodoSearchForm();
        $resumen_form = $this->createResumenSearchForm();
        $comentario_form = $this->createComentarioEstadisticaForm();
        return $this->render('UNAHSGOBundle:Documento:index.html.twig', array(
            'periodo_tipo_form' => $periodo_tipo_form->createView(),
            'periodo_form' => $periodo_form->createView(),
            'resumen_form' => $resumen_form->createView(),
            'comentario_form' => $comentario_form->createView(),
        ));
    }
    
    public function tipoAction($tipo)
    {
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        
        $query = $qb->select('d')
            ->from('UNAH\SGOBundle\Entity\Documento', 'd')
            ->where('d.tipo = :tipo')
            ->andWhere('d.recibido = :recibido')
            ->setParameter('tipo', $tipo)
            ->setParameter('recibido', TRUE)
            ->setMaxResults(10)
            ->orderBy('d.id', 'DESC')
            ->getQuery();
        
        $recibidos = $query->getResult();
        
        $query = $qb->select('d')
            ->where('d.tipo = :tipo')
            ->andWhere('d.recibido = :recibido')
            ->setParameter('tipo', $tipo)
            ->setParameter('recibido', FALSE)
            ->setMaxResults(10)
            ->orderBy('d.id', 'DESC')
            ->getQuery();
        
        $enviados = $query->getResult();
        
        $query = $qb->select('d')
            ->where('d.tipo = :tipo')
            ->andWhere('d.recibido = :recibido')
            ->andWhere('d.clasificar = :clasificar')
            ->setParameter('tipo', $tipo)
            ->setParameter('recibido', TRUE)
            ->setParameter('clasificar', TRUE)
            ->orderBy('d.id', 'DESC')
            ->getQuery();
        
        $clasificar = $query->getResult();
        
        $qb2 = $em->createQueryBuilder();
        
        $query2 = $qb2->select('a','d')
            ->from('UNAH\SGOBundle\Entity\Accion', 'a')
            ->innerJoin('a.documento', 'd')
            ->where('d.tipo = :tipo')
            ->andWhere('a.completada = :completada')
            ->setParameter('completada', FALSE)
            ->setParameter('tipo', $tipo)
            ->orderBy('a.id', 'DESC')
            ->getQuery();
        
        $acciones = $query2->getResult();
        
        return $this->render('UNAHSGOBundle:Documento:tipo.html.twig', array(
            'tipo' => $tipo,
            'recibidos' => $recibidos,
            'enviados' => $enviados,
            'acciones' => $acciones,
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
        $entity->setRecibio($this->getUser()->getUsername());
        $tipoSolicitud = new TipoSolicitud();
        $em = $this->getDoctrine()->getManager();
        
        if (!$tipo) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }
        
        $form = $this->createForm(new DocumentoRecibidoType(), $entity);
        
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        $tipoSolicitudForm = $this->createForm(new TipoSolicitudType(), $tipoSolicitud);
        $emisor = new Departamento();
        $DepartamentoForm = $this->createForm(new DepartamentoType(), $emisor);
        
        return $this->render('UNAHSGOBundle:Documento:recibir.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'tipo'   => $tipo,
            'tipo_solicitud_form'   => $tipoSolicitudForm->createView(),
            'departamento_form'   => $DepartamentoForm->createView(),
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
            'tipo'   => $tipo,
        ));
    }
    
    public function enviandoDepartamentoAction($tipoDocumento, $tipoDepartamento)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoDocumento = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipoDocumento);
        $tipoDepartamento = $em->getRepository('UNAHSGOBundle:TipoDepartamento')->find($tipoDepartamento);
        
        $entity = new Documento();
        $entity->setEntregado($this->getUser()->getUsername());
        
        if (!$tipoDocumento) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }
        
        $form = $this->createForm(new TipoDocumentoEnviadoType($tipoDepartamento), $entity);
        
        return $this->render('UNAHSGOBundle:Documento:enviar.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'tipo'   => $tipoDocumento,
            'tipoDepartamento' => $tipoDepartamento,
        ));
    }
    
    public function enviandoAction($tipo)
    {
        $entity = new Documento();
        $entity->setEntregado($this->getUser()->getUsername());
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        $emisor = new Departamento();
        $DepartamentoForm = $this->createForm(new DepartamentoType(), $emisor);
        
        if (!$tipo) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }
        
        $form = $this->createForm(new DocumentoEnviadoType(), $entity);
        
        return $this->render('UNAHSGOBundle:Documento:enviar.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'tipo' => $tipo,
            'departamento_form'   => $DepartamentoForm->createView(),
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
            
            if($form->get('respuesta')->getData()) {
                
                $em = $this->getDoctrine()->getManager();
                
                $qb = $em->createQueryBuilder();
                $query = $qb->select('d')
                    ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                    ->where('d.numero = :numero')
                    ->setParameter('numero', $form->get('respuesta')->getData())
                    ->getQuery();
                
                $documento = $query->getOneOrNullResult();
                if($documento) {
                    $em->persist($entity);
                    
                    $entity->addRespuesta($documento);
                    $documento->addRespuesta($entity);
                    $documento->setFechaDeRespuesta($entity->getFechaDeEmision());
                    $documento->setRespondido(TRUE);
                    
                    $comentario = new Comentario();
                    $comentario->setUsuario($this->getUser()->getUsername());
                    $comentario->setFecha($entity->getFechaDeEmision());
                    $comentario->setComentario("Documento Respondido");
                    
                    // Actualizar Comentario anterior
                    $old = $documento->getComentarios()->last();
                    if($old){
                        $old->setFinalizado($comentario->getFecha());
                        $em->persist($old);
                    }
                    
                    $comentario->setDocumento($documento);
                    $documento->addComentario($comentario);
                    
                    $em->persist($comentario);
                    
                    $comentario = new Comentario();
                    $comentario->setUsuario($this->getUser()->getUsername());
                    $comentario->setFecha($entity->getFechaDeEmision());
                    $comentario->setComentario("Respondiendo Documento");
                    $comentario->setDocumento($entity);
                    $entity->addComentario($comentario);
                    
                    $em->persist($comentario);
                    $em->persist($documento);
                }
                else {
                    $this->get('session')->getFlashBag()->add('notice', '¡No se encontró el Documento a responder!');
                    return $this->render('UNAHSGOBundle:Documento:enviar.html.twig', array(
                        'entity' => $entity,
                        'form'   => $form->createView(),
                        'tipo'   => $tipo,
                    ));
                }
            }
            
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
    
    public function enviarCGAAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        
        $entity->setGca(TRUE);
        
        $comentario = new Comentario();
        $comentario->setUsuario($this->getUser()->getUsername());
        $comentario->setFecha($entity->getFechaDeEmision());
        $comentario->setComentario("Documento enviado a CGA");
        $comentario->setDocumento($entity);
        $entity->addComentario($comentario);
        
        $em->persist($comentario);
        $em->persist($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        
        return $this->render('UNAHSGOBundle:Documento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    public function clasificarAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        $entity->setClasificar(TRUE);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
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
     * Displays a form to edit an existing Documento entity.
     *
     */
    public function editRecibidoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        
        $editForm = $this->createForm(new DocumentoRecibidoType(), $entity);
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
    public function updateRecibidoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DocumentoRecibidoType(), $entity);
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        }
        
        return $this->render('UNAHSGOBundle:Documento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Documento entity.
     *
     */
    public function editEnviadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        
        $editForm = $this->createForm(new DocumentoEnviadoType(), $entity);
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
    public function updateEnviadoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UNAHSGOBundle:Documento')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DocumentoEnviadoType(), $entity);
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
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
            foreach($entity->getComentarios() as $comentario) {
                $em->remove($comentario);
            }
            
            foreach($entity->getAdjuntos() as $adjunto) {
                $em->remove($adjunto);
            }
            $tipo = $entity->getTipo();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('documento_documento', array('tipo' => $tipo->getId())));
    }
    
    public function responderAction($documento)
    {
        $em = $this->getDoctrine()->getManager();
        $documento = $em->getRepository('UNAHSGOBundle:Documento')->find($documento);
        
        $entity = new Documento();
        $form = $this->createForm(new DocumentoRespuestaType(), $entity);
        
        return $this->render('UNAHSGOBundle:Documento:responder.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'documento' => $documento,
        ));
    }
    
    public function respuestaAction(Request $request, $documento)
    {
        $entity = new Documento();
        $form = $this->createForm(new DocumentoRespuestaType(), $entity);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
        
        $documento = $em->getRepository('UNAHSGOBundle:Documento')->find($documento);
        
        if ($form->isValid()) {
            $entity->addRespuesta($documento);
            $documento->addRespuesta($entity);
            $documento->setRespondido(TRUE);
            $documento->setFechaDeRespuesta($entity->getFechaDeEmision());
            
            $comentario = new Comentario();
            $comentario->setUsuario($this->getUser()->getUsername());
            $comentario->setFecha($entity->getFechaDeEmision());
            $comentario->setComentario("Documento Respondido");
            $comentario->setDocumento($documento);
            $documento->addComentario($comentario);
            
            // Actualizar Comentario anterior
            $old = $documento->getComentarios()->last();
            if($old){
                $old->setFinalizado($comentario->getFecha());
                $em->persist($old);
            }
            
            $em->persist($comentario);
            
            $comentario = new Comentario();
            $comentario->setUsuario($this->getUser()->getUsername());
            $comentario->setFecha($entity->getFechaDeEmision());
            $comentario->setComentario("Respondiendo Documento");
            $comentario->setDocumento($entity);
            $entity->addComentario($comentario);
            
            $em->persist($comentario);
            $em->persist($entity);
            $em->persist($documento);
            $em->flush();
            
            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        }
        
        return $this->render('UNAHSGOBundle:Documento:responder.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'documento' => $documento,
        ));
    }
    
    public function searchAction()
    {
        $dateForm = $this->createDateSearchForm();
        $numeroForm = $this->createNumeroSearchForm();
        $deptoForm = $this->createDepartamentoSearchForm();
        $emisionForm = $this->createEmisionSearchForm();
        $comentarioForm = $this->createDepartamentoComentarioSearchForm();
        
        return $this->render('UNAHSGOBundle:Documento:search.html.twig', array(
            'date_form' => $dateForm->createView(),
            'emision_form' => $emisionForm->createView(),
            'numero_form' => $numeroForm->createView(),
            'depto_form' => $deptoForm->createView(),
            'comentario_form' => $comentarioForm->createView(),
        ));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/estadistica/fecha", name="documento_estadistica_fecha")
    * @Method("GET")
    * @Template()
    */
    public function estadisticaPeriodoAction(Request $request)
    {
        $form = $this->createPeriodoSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $qb = $em->createQueryBuilder();
            
            $query = $qb->select('count(d)')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $recibidos = $query->getSingleScalarResult();
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeEnvio', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', FALSE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $enviados = $query->getSingleScalarResult();
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.respondido = :respondido')
                ->setParameter('recibido', TRUE)
                ->setParameter('respondido', FALSE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $noRespondidos = $query->getSingleScalarResult();
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.respondido = :respondido')
                ->andWhere('d.responder = :responder')
                ->setParameter('recibido', TRUE)
                ->setParameter('respondido', TRUE)
                ->setParameter('responder', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $respondidos = $query->getSingleScalarResult();
            
            $qb = $em->createQueryBuilder('d', 't');
            $query = $qb->select('count(d) as cantidad, t.nombre, t.color')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.tipo', 't')
                ->where($qb->expr()->between('d.fechaDeEnvio', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->groupBy('t.id')
                ->setParameter('recibido', FALSE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $tipo = $query->getResult();
            
            $qb = $em->createQueryBuilder('d', 't');
            $query = $qb->select('count(d) as cantidad, t.nombre')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.tipo', 't')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->groupBy('t.id')
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $tipo_recibido = $query->getResult();
            
            $qb = $em->createQueryBuilder('d', 'e');
            $query = $qb->select('count(d) as cantidad, e.nombre, e.color')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.emisor', 'e')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->groupBy('e.id')
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            
            $emisor = $query->getResult();
            
            $qb = $em->createQueryBuilder('d', 't');
            $query = $qb->select('count(d) as cantidad, t.nombre, t.color')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.tipoSolicitud', 't')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->groupBy('t.id')
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            
            $tipificacion = $query->getResult();
            
            return array(
                'recibidos' => $recibidos,
                'respondidos' => $respondidos,
                'noRespondidos' => $noRespondidos,
                'enviados' => $enviados,
                'emisor' => $emisor,
                'tipo' => $tipo,
                'tipo_recibido' => $tipo_recibido,
                'tipificacion' => $tipificacion,
                'inicio' => $form->get('inicio_periodo')->getData(),
                'fin' => $form->get('fin_periodo')->getData(),
                'date_form' => $form->createView(),
            );
        }
        return $this->redirect($this->generateUrl('documento'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/estadistica/resumen", name="documento_estadistica_resumen")
    * @Method("GET")
    * @Template()
    */
    public function resumenPeriodoAction(Request $request) {
        $form = $this->createResumenSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $qb = $em->createQueryBuilder();
            
            $query = $qb->select('count(d)')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo1')->getData())
                ->setParameter('fin', $form->get('fin_periodo1')->getData())
                ->getQuery();
            $recibidos = $query->getSingleScalarResult();
            
            $qb = $em->createQueryBuilder('d', 't');
            $query = $qb->select('count(d) as cantidad, count(d) / :total *100 as porcentaje, t.nombre, t.color')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.tipoSolicitud', 't')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->groupBy('t.id')
                ->setParameter('total', $recibidos)
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo1')->getData())
                ->setParameter('fin', $form->get('fin_periodo1')->getData())
                ->getQuery();
            
            $tipificacion = $query->getResult();
            
            $qb = $em->createQueryBuilder('d', 't');
            $query = $qb->select('count(d) as cantidad, count(d) / :total *100 as porcentaje, t.nombre, t.color')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.tipoSolicitud', 't')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.gca = :cga')
                ->groupBy('t.id')
                ->setParameter('total', $recibidos)
                ->setParameter('recibido', TRUE)
                ->setParameter('cga', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo1')->getData())
                ->setParameter('fin', $form->get('fin_periodo1')->getData())
                ->getQuery();
            
            $cga = $query->getResult();
            
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.responder = :responder')
                ->andWhere('d.respondido = :respondido')
                ->setParameter('respondido', TRUE)
                ->setParameter('responder', TRUE)
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo1')->getData())
                ->setParameter('fin', $form->get('fin_periodo1')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            
            $tiempo = 0;
            foreach($documentos as $documento) {
                $tiempo += $documento->getTiempoRespuesta();
            }
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.responder = :responder')
                ->andWhere('d.respondido = :respondido')
                ->setParameter('respondido', TRUE)
                ->setParameter('responder', TRUE)
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo1')->getData())
                ->setParameter('fin', $form->get('fin_periodo1')->getData())
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            if($count != 0)
            {
                $tiempo = $tiempo / $count;
            }
            
            return array(
                'recibidos' => $recibidos,
                'tipificacion' => $tipificacion,
                'cga' => $cga,
                'tiempo' => $tiempo,
                'count' => $count,
                'inicio' => $form->get('inicio_periodo1')->getData(),
                'fin' => $form->get('fin_periodo1')->getData(),
            );
        }
        return $this->redirect($this->generateUrl('documento'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/estadistica/fecha", name="documento_estadistica_fecha")
    * @Method("GET")
    * @Template()
    */
    public function estadisticaPeriodoTipoAction(Request $request)
    {
        $form = $this->createDateSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $tipo = $form->get('tipo')->getData();
            $qb = $em->createQueryBuilder();
            
            $query = $qb->select('count(d)')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            
            $recibidos = $query->getSingleScalarResult();
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeEnvio', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('recibido', FALSE)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            
            $enviados = $query->getSingleScalarResult();
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.respondido = :respondido')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('recibido', TRUE)
                ->setParameter('respondido', FALSE)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            $noRespondidos = $query->getSingleScalarResult();
            
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->andWhere('d.respondido = :respondido')
                ->setParameter('tipo', $tipo)
                ->setParameter('recibido', TRUE)
                ->setParameter('respondido', TRUE)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            
            $respondidos = $query->getSingleScalarResult();
            
            $qb = $em->createQueryBuilder('d', 'e');
            $query = $qb->select('count(d) as cantidad, e.nombre')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.emisor', 'e')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->groupBy('e.id')
                ->setParameter('tipo', $tipo)
                ->setParameter('recibido', TRUE)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            
            $emisor = $query->getResult();
            
            return array(
                'recibidos' => $recibidos,
                'respondidos' => $respondidos,
                'noRespondidos' => $noRespondidos,
                'enviados' => $enviados,
                'emisor' => $emisor,
                'inicio' => $form->get('inicio')->getData(),
                'fin' => $form->get('fin')->getData(),
                'date_form' => $form->createView(),
                'tipo' => $tipo,
            );
        }
        return $this->redirect($this->generateUrl('documento'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/fecha", name="oficio_search_fecha")
    * @Method("GET")
    * @Template()
    */
    public function searchDateAction(Request $request)
    {
        $form = $this->createDateSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $tipo = $form->get('tipo')->getData();
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', TRUE)
                ->setParameter('tipo', $tipo)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', TRUE)
                ->setParameter('tipo', $tipo)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            return array(
                'documentos' => $documentos,
                'inicio' => $form->get('inicio')->getData(),
                'fin' => $form->get('fin')->getData(),
                'date_form' => $form->createView(),
                'count' => $count,
                'tipo' => $tipo,
            );
        }
        return $this->redirect($this->generateUrl('documento_search'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/emitido", name="documento_search_emitido")
    * @Method("GET")
    * @Template()
    */
    public function searchEmisionAction(Request $request)
    {
        $form = $this->createEmisionSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $tipo = $form->get('tipo')->getData();
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where($qb->expr()->between('d.fechaDeEmision', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', FALSE)
                ->setParameter('inicio', $form->get('inicio_emision')->getData())
                ->setParameter('fin', $form->get('fin_emision')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeEmision', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', FALSE)
                ->setParameter('tipo', $tipo)
                ->setParameter('inicio', $form->get('inicio_emision')->getData())
                ->setParameter('fin', $form->get('fin_emision')->getData())
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            return array(
                'documentos' => $documentos,
                'inicio' => $form->get('inicio_emision')->getData(),
                'fin' => $form->get('fin_emision')->getData(),
                'date_form' => $form->createView(),
                'count' => $count,
                'tipo' => $tipo,
            );
        }
        return $this->redirect($this->generateUrl('documento_search'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/fecha", name="documento_search_numero")
    * @Method("GET")
    * @Template()
    */
    public function searchNumeroAction(Request $request)
    {
        $form = $this->createNumeroSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $tipo = $form->get('tipo')->getData();
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where('d.numero LIKE :numero')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('numero', "%".$form->get('numero')->getData()."%")
                ->getQuery();
            
            $documentos = $query->getResult();
            
            $query = $qb->select('count(d)')
                ->where('d.numero = :numero')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('numero', "%".$form->get('numero')->getData()."%")
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            return array(
                'documentos' => $documentos,
                'numero' => $form->get('numero')->getData(),
                'numero_form' => $form->createView(),
                'count' => $count,
                'tipo' => $tipo,
            );
        }
        return $this->redirect($this->generateUrl('documento_search'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/fecha", name="documento_search_departamento")
    * @Method("GET")
    * @Template()
    */
    public function searchDepartamentoAction(Request $request)
    {
        $form = $this->createDepartamentoSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $tipo = $form->get('tipo')->getData();
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where('d.emisor = :emisor')
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', TRUE)
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            $query = $qb->select('count(d)')
                ->where('d.emisor = :emisor')
                ->andwhere('d.tipo = :tipo')
                ->andWhere('d.recibido = :recibido')
                ->setParameter('recibido', TRUE)
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            return array(
                'documentos' => $documentos,
                'departamento' => $form->get('emisor')->getData(),
                'depto_form' => $form->createView(),
                'count' => $count,
                'tipo' => $tipo,
            );
        }
        return $this->redirect($this->generateUrl('documento_search'));
    }
    
    /**
    * Permite Efectuar busquedas por fecha
    *
    * @Route("/fecha", name="oficio_search_numero")
    * @Method("GET")
    * @Template()
    */
    public function searchDepartamentoComentarioAction(Request $request)
    {
        $form = $this->createDepartamentoComentarioSearchForm();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $tipo = $form->get('tipo')->getData();
            $emisor = $form->get('emisor')->getData();
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where('d.descripcion LIKE :descripcion')
                ->andWhere('d.emisor = :emisor')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $emisor)
                ->setParameter('descripcion', "%".$form->get('descripcion')->getData()."%")
                ->getQuery();
            
            $documentos = $query->getResult();
            
            $query = $qb->select('count(d)')
                ->where('d.emisor = :emisor')
                ->andwhere('d.descripcion LIKE :descripcion')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->setParameter('descripcion', "%".$form->get('descripcion')->getData()."%")
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            return array(
                'documentos' => $documentos,
                'departamento' => $form->get('emisor')->getData(),
                'descripcion' => $form->get('descripcion')->getData(),
                'depto_form' => $form->createView(),
                'count' => $count,
                'tipo' => $tipo,
            );
        }
        return $this->redirect($this->generateUrl('documento_search'));
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
    
    private function createDepartamentoSearchForm() {
        return $this -> createFormBuilder()
        ->add('emisor', 'entity', array(
                        'class' => 'UNAH\SGOBundle\Entity\Departamento',
                        )
        )
        ->add('tipo', 'entity', array(
            'label' => 'Documento',
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createNumeroSearchForm()
    {
        return $this->createFormBuilder()
        ->add('numero')
        ->add('tipo', 'entity', array(
            'label' => 'Documento',
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createDateSearchForm()
    {
        return $this->createFormBuilder()
        ->add('inicio', 'date', array(
                    'label' => 'Fecha Inicial',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->add('fin', 'date', array(
                    'label' => 'Fecha Final',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->add('tipo', 'entity', array(
            'label' => 'Documento',
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createPeriodoSearchForm()
    {
        return $this->createFormBuilder()
       ->add('inicio_periodo', 'date', array(
               'label' => 'Fecha Inicial',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'attr' => array('class' => 'datepicker')))
       ->add('fin_periodo', 'date', array(
               'label' => 'Fecha Final',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'attr' => array('class' => 'datepicker')))
       ->getForm();
    }
    
    private function createResumenSearchForm()
    {
        return $this->createFormBuilder()
       ->add('inicio_periodo1', 'date', array(
               'label' => 'Fecha Inicial',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'attr' => array('class' => 'datepicker')))
       ->add('fin_periodo1', 'date', array(
               'label' => 'Fecha Final',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'attr' => array('class' => 'datepicker')))
       ->getForm();
    }
    
    private function createEmisionSearchForm()
    {
        return $this->createFormBuilder()
        ->add('inicio_emision', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker')))
        ->add('fin_emision', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker')))
        ->add('tipo', 'entity', array(
            'label' => 'Documento',
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createDepartamentoComentarioSearchForm()
    {
        return $this->createFormBuilder()
        ->add('descripcion', 'textarea', array(
            'label' => 'Descripción'
        ))
        ->add('emisor', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\Departamento',
            )
        )
        ->add('tipo', 'entity', array(
            'label' => 'Documento',
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createComentarioEstadisticaForm()
    {
        return $this->createFormBuilder()
        ->add('inicio_comentario', 'date', array(
                    'label' => 'Fecha Inicial',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->add('fin_comentario', 'date', array(
                    'label' => 'Fecha Final',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->getForm();
    }
}
