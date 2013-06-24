<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use UNAH\SGOBundle\Entity\Instancia;

class LoadInstanciaData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this -> container = $container;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $instancias = array(
            'Dirección Academica de Formación Tecnologica',
            'Dirección de Admisión',
            'Dirección de Autoevaluación',
            'Dirección de Cultura',
            'Dirección de Docencia',
            'Dirección de Educación Superior',
            'Dirección de Estudios de Postgrado',
            'Dirección de Evaluación Permanente de la Calidad',
            'Dirección de Formación Tecnologica',
            'Dirección de Ingreso, Permanencia y Promoción',
            'Dirección de Innovación Educativa',
            'Dirección de Investigación Cientifica',
            'Dirección de la DIE',
            'Dirección de Vinculación Universidad Sociedad',
            'Dirección del Instituto de Profesionalización y Superación Docente',
            'Dirección del Observatorio',
            'Dirección del Sistema de Administración',
            'Dirección del Sistema de Educación a Distancia',
            'Dirección Escuela Madrid',
            'Dirección Instituto Forestal',
            'Director ITST',
            'ETF',
            'Oficina de Registro',
            'Prosene',
            'Secretaria Ejecutiva de Desarrollo de Personal',
            'Secretaria General',
            'Secretario SEDI',
            'SEDINAFROH',
            'SUED',
            'VOAE'
        );
        $colores = ColorGenerator::generateUniqueHexColors(count($instancias));
        
        foreach ($instancias as $i => $nombre) {
            $entity = new Instancia();
            $entity->setNombre($nombre);
            $entity->setColor($colores[$i]);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }
}

