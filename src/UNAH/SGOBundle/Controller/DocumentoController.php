<?php

namespace UNAH\SGOBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use UNAH\SGOBundle\Entity\Documento;
use UNAH\SGOBundle\Form\DocumentoType;
use UNAH\SGOBundle\Form\DocumentoRecibidoType;
use UNAH\SGOBundle\Form\DocumentoEnviadoType;
use UNAH\SGOBundle\Form\DocumentoRespuestaType;

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
        return $this->render('UNAHSGOBundle:Documento:index.html.twig', array(
            'periodo_tipo_form' => $periodo_tipo_form->createView(),
            'periodo_form' => $periodo_form->createView(),
        ));
    }
    
    public function tipoAction($tipo)
    {
        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UNAHSGOBundle:TipoDocumento')->find($tipo);
        
        return $this->render('UNAHSGOBundle:Documento:tipo.html.twig', array(
            'tipo' => $tipo,
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
            $em->persist($entity);
            $documento->addRespuesta($entity);
            $documento->setRespondido(TRUE);
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
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
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
                ->setParameter('respondido', TRUE)
                ->setParameter('inicio', $form->get('inicio_periodo')->getData())
                ->setParameter('fin', $form->get('fin_periodo')->getData())
                ->getQuery();
            $respondidos = $query->getSingleScalarResult();
            
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
            
            $qb = $em->createQueryBuilder('d', 't');
            $query = $qb->select('count(d) as cantidad, t.nombre')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->leftJoin('d.tipo', 't')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
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
            $query = $qb->select('count(d) as cantidad, e.nombre')
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
            
            return array(
                'recibidos' => $recibidos,
                'respondidos' => $respondidos,
                'noRespondidos' => $noRespondidos,
                'enviados' => $enviados,
                'emisor' => $emisor,
                'tipo' => $tipo,
                'tipo_recibido' => $tipo_recibido,
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
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
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
                ->setParameter('tipo', $tipo)
                ->setParameter('inicio', $form->get('inicio')->getData())
                ->setParameter('fin', $form->get('fin')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeRecibido', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
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
    * @Route("/emitido", name="oficio_search_emitido")
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
                ->setParameter('inicio', $form->get('inicio_emision')->getData())
                ->setParameter('fin', $form->get('fin_emision')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            $query = $qb->select('count(d)')
                ->where($qb->expr()->between('d.fechaDeEmision', ':inicio', ':fin'))
                ->andwhere('d.tipo = :tipo')
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
    * @Route("/fecha", name="oficio_search_numero")
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
    * @Route("/fecha", name="oficio_search_numero")
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
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->getQuery();
            
            $documentos = $query->getResult();
            $query = $qb->select('count(d)')
                ->where('d.emisor = :emisor')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $form->get('emisor')->getData())
                ->getQuery();
            $count = $query->getSingleScalarResult();
            
            return array(
                'documento' => $documentos,
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
            $qb = $em->createQueryBuilder();
            $query = $qb->select('d')
                ->from('UNAH\SGOBundle\Entity\Documento', 'd')
                ->where('d.emisor = :emisor')
                ->andwhere('d.descripcion LIKE :descripcion')
                ->andwhere('d.tipo = :tipo')
                ->setParameter('tipo', $tipo)
                ->setParameter('emisor', $form->get('emisor')->getData())
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
        ->add('tipo', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->add('emisor', 'entity', array(
                        'class' => 'UNAH\SGOBundle\Entity\Departamento',
                        )
        )
        ->getForm();
    }
    
    private function createNumeroSearchForm()
    {
        return $this->createFormBuilder()
        ->add('numero')
        ->add('tipo', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createDateSearchForm()
    {
        return $this->createFormBuilder()
        ->add('inicio', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->add('fin', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker')))
        ->add('tipo', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createPeriodoSearchForm()
    {
        return $this->createFormBuilder()
       ->add('inicio_periodo', 'date', array(
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'attr' => array('class' => 'datepicker')))
       ->add('fin_periodo', 'date', array(
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
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->getForm();
    }
    
    private function createDepartamentoComentarioSearchForm()
    {
        return $this->createFormBuilder()
        ->add('descripcion', 'textarea')
        ->add('tipo', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\TipoDocumento',
            )
        )
        ->add('descripcion', 'textarea')
        ->add('emisor', 'entity', array(
            'class' => 'UNAH\SGOBundle\Entity\Departamento',
            )
        )
        ->getForm();
    }
}
