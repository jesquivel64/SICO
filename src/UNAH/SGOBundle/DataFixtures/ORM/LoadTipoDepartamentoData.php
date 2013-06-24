<?php

namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\TipoDepartamento;

class LoadTipoDepartamentoData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $colores = ColorGenerator::generateUniqueHexColors(4);
        
        $carrera = new TipoDepartamento();
        $carrera->setNombre("Carrera");
        $carrera->setColor($colores[0]);
        $manager->persist($carrera);
        
        $facultad = new TipoDepartamento();
        $facultad->setNombre("Facultad");
        $facultad->setColor($colores[1]);
        $manager->persist($facultad);
        
        $instancia = new TipoDepartamento();
        $instancia->setNombre("Instancia");
        $instancia->setColor($colores[2]);
        $manager->persist($instancia);
        
        $centro = new TipoDepartamento();
        $centro->setNombre("Centro de Estudios");
        $centro->setColor($colores[3]);
        $manager->persist($centro);
        
        $manager->flush();
        
        $this->addReference('carrera', $carrera);
        $this->addReference('facultad', $facultad);
        $this->addReference('instancia', $instancia);
        $this->addReference('centro', $centro);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10; // the order in which fixtures will be loaded
    }
}
