<?php
namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UNAH\SGOBundle\Entity\TipoSolicitud;

class LoadTipoSolicitudData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $solicitudes = array(
            'Agregados',
            'Asunto  legal',
            'Asuntos Administrativos',
            'Cambio de Carrera',
            'Cancelación Excepcional de Asignaturas',
            'Casos Sujetos a Investigación',
            'Certificación de Calificaciones',
            'Equivalencias Automáticas',
            'Errores de Programación y Cambios de Programación',
            'Estudiantes  que no Logran Ingresar a la UNAH con la PAA',
            'Examen Opcional de Suficiencia',
            'Habilitación de  Cuenta',
            'Ingreso a la UNAH',
            'Inscripción de Asignaturas',
            'Inscripción de Calificaciones', 
            'Matrícula Condicionada',
            'Pago de Matrícula y/o Laboratorio',
            'Problemas  para Entregar Título de Educación Media',
            'Problemas en Historiales Académicos y Planes de Estudios',
            'Problemas relacionados con la matrícula de asignaturas',
            'Rectificación de Calificaciones',
            'Segunda Carrera',
            'Solicitud de Reingreso a la UNAH',
            'Solicitudes Postgrados',
            'Tramites Académicos',
            'Trámites de Práctica Profesional, Graduación, y Títulos',
            'Traslape de Clase con laboratorios',
            'Varios',
        );
        
        $colores = ColorGenerator::generateUniqueHexColors(count($solicitudes));
        
        foreach ($solicitudes as $i => $nombre) {
            $entity = new TipoSolicitud();
            $entity->setNombre($nombre);
            $entity->setColor($colores[$i]);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}
