<?php


namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\Carrera;

class LoadCarreraData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $carreras =  array(
            'Actividad Física para la salud',
            'Administración de Empresas',
            'Administración de Empresas con Orientación en Finanzas, Mercadotecnia o Recursos Humanos',
            'Administración de Empresas Internacionales',
            'Alimentos y Bebidas',
            'Anatomía Patológica',
            'Anestesiología, Reanimación y Dolor',
            'Astronomia y Astrofisica',
            'Atención al Niño y Adolescente',
            'Centroamericano en Economia  y Planificación del Desarrollo',
            'Centroamericano en Economia y Planificacion del Desarrollo (POSCAE)',
            'Ciencias Acuícolas',
            'Ciencia Politica y Gestion Estatal',
            'Ciencias Sociales con Enfasis en Gestion del Desarrollo (pertenece al PLATS)',
            'Cirugía General',
            'Cirugía Plastica y Reconstructiva',
            'Comunicación y Tecnologia',
            'Cuidados Intensivos Pediatricos',
            'Demografia Social (pertenece al PLAST)',
            'Derecho Mercantil',
            'Derecho Penal y Procesal',
            'Desarrollo Municipal',
            'Dermatología',
            'Dirección de Negocios Internacionales',
            'Diseño, Gestión y Evaluación Curricular',
            'Docencia Superior',
            'Educación en Ciencias',
            'Educación Superior',
            'Educación Basica para la Enseñanza del Español',
            'Educación para el Trabajo',
            'Educación para la Gestión del Desarrollo Local',
            'Educación Social',
            'Enfermería de Quirófano',
            'Epidemiología',
            'Fisica',
            'Forestería Comunitaria',
            'Formulacion, Gestión y Evaluación de Proyectos (pertenece al POSCAE)',
            'Gestión de Empresas Cooperativas',
            'Gestión del riesgo y Manejo de Desastres Naturales',
            'Gestión Social y Urbana (pertenece al PLATS)',
            'Ginecología y Obstetricia',
            'Ingenieria de la Construcción y Gerencia de Proyectos',
            'Ingenieria Estructural',
            'Literatura Centroamericana',
            'Marketing con Enfasis en Negocios Internacionales',
            'Medicina de Rehabilitación',
            'Medicina del Trabajo',
            'Medicina Interna',
            'Micro Finanzas',
            'Neurocirugia',
            'Neurología',
            'Oftalmología',
            'Oncología Quirurgica',
            'Ordenamiento y Gestión del Territorio',
            'Ortopedia y Traumatología',
            'Otorrinolaringología',
            'Pediatría',
            'Planificación y Desarrollo Turistico (pertenece al POSCAE)',
            'Psiquiatría',
            'Rehabilitación Bucal en Prótesis',
            'Salud Familiar',
            'Salud Materno Perinatal',
            'Salud Publica',
            'Tecnología y Control de Medicamentos',
            'Trabajo Social con Orientación en Gestión del Desarrollo( pertenece al PLATS)',
            'Derechos Humanos y Desarrollo',
            'Docencia Superior',
            'Administración Aduanera',
            'Administración Bancaria',
            'Administración de Empresas',
            'Administración de Empresas Agropecuarias',
            'Administración Pública',
            'Antropologia',
            'Arquitectura',
            'Arte',
            'Banca y Finanzas',
            'Biología',
            'Ciencias Navales',
            'Comercio Internacional',
            'Comercio Internacional con Orientación en Agroindustria',
            'Contaduría Pública y Finanzas',
            'Derecho',
            'Economía',
            'Economía Agricola',
            'Ecoturismo',
            'Educación Física',
            'Enfermería',
            'Filosofía',
            'Física',
            'Historia',
            'Informatica Administrativa',
            'Ing. En Ciencias Acuicolas',
            'Ingeniería Agroindustrial',
            'Ingeniería Agronomica',
            'Ingeniería Civil',
            'Ingeniería de Quimica y Farmacia',
            'Ingeniería Electrica Industrial',
            'Ingeniería en Ciencias Acuícolas y Recursos Marino Costeros',
            'Ingeniería en Sistemas',
            'Ingeniería Forestal',
            'Ingeniería Industrial',
            'Ingeniería Mecanica Industrial',
            'Lenguaje de Señas',
            'Lenguas Extranjeras',
            'Letras',
            'Matemáticas',
            'Medicina',
            'Metalurgia',
            'Mercadotecnia',
            'Microbiología',
            'Música',
            'Nutrición',
            'Odontología',
            'Pedagogía',
            'Periodismo',
            'Procesamiento de Granos y Semillas',
            'Producción Agrícola',
            'Producción Pecuaria',
            'Psicología',
            'Quimica Industrial',
            'Química y Farmacia',
            'Radiologia',
            'Radio Tecnología (Rayos X)',
            'Sociología',
            'Tecnología de Alimentos',
            'Terapia Funcional',
            'Trabajo Social'
        );
        $colores = ColorGenerator::generateUniqueHexColors(count($carreras));
        
        foreach ($carreras as $i => $nombre) {
            $entity = new Carrera();
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
        return 5; // the order in which fixtures will be loaded
    }
}

