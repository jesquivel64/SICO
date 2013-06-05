<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\TipoAccion;

class LoadTipoAccionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $colores = ColorGenerator::generateUniqueHexColors(5);
        $tipos = array(
            'Archivado',
            'Trasladar a para emitir Dictamen',
            'Trasladar a para emitir Resolución',
            'Programar Reunión, Cita, Taller o Evento',
            'Elaborar Oficio de Respuesta',
        );
        
        foreach ($tipos as $i => $nombre) {
            $entity = new TipoAccion();
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
        return 6; // the order in which fixtures will be loaded
    }
}

