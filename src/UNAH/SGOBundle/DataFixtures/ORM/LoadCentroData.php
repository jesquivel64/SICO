<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\Centro;

class LoadCentroData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $centros = array(
            'Ciudad Universitaria (CU)',
            'CURLA',
            'CUROC',
            'CURVA',
            'CURC',
            'CURLP',
            'CURNO',
            'CURN',
            'CURO',
            'TEC Danlí',
            'Valle de Sula'
        );
        $colores = ColorGenerator::generateUniqueHexColors(count($centros));
        
        foreach ($centros as $i => $nombre) {
            $entity = new Centro();
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
        return 2; // the order in which fixtures will be loaded
    }
}

