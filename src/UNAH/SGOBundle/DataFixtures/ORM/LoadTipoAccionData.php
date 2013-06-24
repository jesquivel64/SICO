<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use UNAH\SGOBundle\Entity\TipoAccion;

class LoadTipoAccionData implements FixtureInterface, ContainerAwareInterface
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
        $tipos = array(
            'Archivado',
            'Trasladar a para emitir Dictamen',
            'Trasladar a para emitir Resolución',
            'Programar Reunión, Cita, Taller o Evento',
            'Elaborar Oficio de Respuesta',
        );
        $colores = ColorGenerator::generateUniqueHexColors(count($tipos));
        
        foreach ($tipos as $i => $nombre) {
            $entity = new TipoAccion();
            $entity->setNombre($nombre);
            $entity->setColor($colores[$i]);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }
}

