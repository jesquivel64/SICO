<?php

namespace UNAH\SGOBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use UNAH\SGOBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this -> container = $container;
    }

    public function load(ObjectManager $manager) {
        $userManager = $this -> container -> get('fos_user.user_manager');

        $user = $userManager -> createUser();
        $user -> setUsername('Administrador');
        $user -> setPlainPassword('1234');
        $user -> setEnabled(1);
        $user -> addRole('role_super_admin');
        $user -> setEmail('vicerrectoriaacademica@unah.edu.hn');
        $userManager -> updateUser($user);
    }
}
