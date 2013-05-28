<?php
namespace Acme\HelloBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UNAH\SGOBundle\Entity\TipoSolicitud;

class LoadTipoSolicitudData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $object = new TipoSolicitud();
        $object->setNombre('Cambio de Carrera');
        $object->setColor('#9966FF');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Rectificación e Inscripción de Calificaciones');
        $object->setColor('#E666FF');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Ingreso a la UNAH');
        $object->setColor('#FF66CC');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Errores  de Programación y cambios de Programación');
        $object->setColor('#FF667F');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Varios');
        $object->setColor('#FF9966');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Examen Opcional de suficiencia');
        $object->setColor('#66CCFF');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Segunda Carrera');
        $object->setColor('#9CEB00');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Equivalencias Automáticas');
        $object->setColor('#FFE666');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Habilitación de  Cuenta');
        $object->setColor('#66FF99');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Certificación de Calificaciones');
        $object->setColor('#CC334D');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Estudiantes  que no logran ingresar a la UNAH con la PAA');
        $object->setColor('#CC3399');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Problemas relacionados con la matrícula de asignaturas');
        $object->setColor('#E495CA');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Solicitud de Reingreso a la UNAH');
        $object->setColor('#FF6666');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Asuntos Administrativos');
        $object->setColor('#EB00EB');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Problemas en Historiales Académicos y Planes de Estudios');
        $object->setColor('#FF29FF');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Agregados');
        $object->setColor('#FFFF66');
        
        $manager->persist($object);
        
        $object = new TipoSolicitud();
        $object->setNombre('Cancelación de Asignaturas');
        $object->setColor('#FFCC99');
        
        $manager->persist($object);
        
        $manager->flush();
    }
}
