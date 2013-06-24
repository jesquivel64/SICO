<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\TipoDocumento;

class LoadTipoDocumentoData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $tipos = array(
            'Oficio' => array('Oficios', 'oficio'),
            'Dictamen' => array('Dictamenes', 'dictamen'),
            'Memorandum' => array('Memorandums', 'memorandum'),
            'Circular' => array('Circulares', 'circular'),
            'Dictamen' => array('Dictamenes', 'dictamen'),
            'Resolución' => array('Resoluciones', 'resolucion'),
        );
        
        foreach ($tipos as $nombre => $opciones) {
            $entity = new TipoDocumento();
            $entity->setNombre($nombre);
            $entity->setPlural($opciones[0]);
            $entity->setImagen($opciones[1]);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}

