<?php

namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNAH\SGOBundle\Entity\TipoDepartamento;
use UNAH\SGOBundle\Entity\Departamento;

class LoadDepartamentoData extends AbstractFixture implements OrderedFixtureInterface
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
        
        $facultades = array(
            'Facultad de Ciencias',
            'Facultad de Ciencias Económicas',
            'Facultad de Ciencias Espaciales',
            'Facultad de Ciencias Jurídicas',
            'Facultad de Ciencias Medicas',
            'Facultad de Ingeniería',
            'Facultad de Odontología',
            'Facultad de Quimica y Farmacia',
            'Facultad Humanidades y Arte'
        );
        
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
        
        $centros = array(
            'Valle de Sula',
            'TEC Danlí',
            'Ciudad Universitaria (CU)',
            'Litoral Atlántico CURLA',
            'CUROC',
            'CURVA',
            'CURC',
            'CURLP',
            'CURNO',
            'CURN',
            'CURO'
        );
        
        $carrera = $this->getReference('carrera');
        $facultad = $this->getReference('facultad');
        $instancia = $this->getReference('instancia');
        $centro = $this->getReference('centro');
        
        $coloresCarreras = ColorGenerator::generateUniqueHexColors(count($carreras));
        $coloresFacultades = ColorGenerator::generateUniqueHexColors(count($facultades));
        $coloresInstancias = ColorGenerator::generateUniqueHexColors(count($instancias));
        $coloresCentros = ColorGenerator::generateUniqueHexColors(count($centros));
        
        foreach ($carreras as $i => $nombre) {
            $entity = new Departamento();
            $entity->setNombre($nombre);
            $entity->setColor($coloresCarreras[$i]);
            $entity->setTipoDepartamento($carrera);
            $manager->persist($entity);
        }
        
        foreach ($facultades as $i => $nombre) {
            $entity = new Departamento();
            $entity->setNombre($nombre);
            $entity->setColor($coloresFacultades[$i]);
            $entity->setTipoDepartamento($facultad);
            $manager->persist($entity);
        }
        
        foreach ($instancias as $i => $nombre) {
            $entity = new Departamento();
            $entity->setNombre($nombre);
            $entity->setColor($coloresInstancias[$i]);
            $entity->setTipoDepartamento($instancia);
            $manager->persist($entity);
        }
        
        foreach ($centros as $i => $nombre) {
            $entity = new Departamento();
            $entity->setNombre($nombre);
            $entity->setColor($coloresCentros[$i]);
            $entity->setTipoDepartamento($centro);
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
