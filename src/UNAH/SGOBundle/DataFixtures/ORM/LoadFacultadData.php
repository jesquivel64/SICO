<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\Facultad;

class LoadFacultadData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $facultades = array(
            'Ciencias',
            'Ciencias Económicas',
            'Ciencias Espaciales',
            'Ciencias Jurídicas',
            'Ciencias Medicas',
            'Ingeniería',
            'Odontología',
            'Quimica y Farmacia',
            'Humanidades y Arte'
        );
        $colores = ColorGenerator::generateUniqueHexColors(count($facultades));
        
        foreach ($facultades as $i => $nombre) {
            $entity = new Facultad();
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

