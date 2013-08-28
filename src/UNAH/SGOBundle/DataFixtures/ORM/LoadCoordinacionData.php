<?php
namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UNAH\SGOBundle\Entity\Coordinacion;
use UNAH\SGOBundle\Entity\TipoSolicitud;

class LoadCoordinacionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $coordinaciones = array(
            1 => array(
                'nombre' => 'Coordinación de Gestión Académica',
                'solicitudes' => array(
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
                )
            )
        );
        
        $colores = ColorGenerator::generateUniqueHexColors(count($coordinaciones) + 1);
        
        foreach ($coordinaciones as $i => $coordinacion) {
            $entity = new Coordinacion();
            $entity->setNombre($coordinacion['nombre']);
            $entity->setColor($colores[$i]);
            $sol_color = ColorGenerator::generateUniqueHexColors(count($coordinacion['solicitudes']));
            $manager->persist($entity);
            foreach($coordinacion['solicitudes'] as $j => $nombre)
            {
                $solicitud = new TipoSolicitud();
                $solicitud->setNombre($nombre);
                $solicitud->setColor($sol_color[$j]);
                $manager->persist($solicitud);
            }
        }
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}
