<?php
namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $encoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Kosmetos');
        $user->setEmail('johnk@afrihost.com');
        $user->setUsername('johnk');
        $user->setRoles(array('ROLE_LECTURER'));
        $user->setPassword($encoder->encodePassword($user, 'johnk1234'));

        $manager->persist($user);

        $user = new User();
        $user->setFirstName('Sacheen');
        $user->setLastName('Dhanjie');
        $user->setEmail('sacheend@afrihost.com');
        $user->setUsername('sacheend');
        $user->setRoles(array('ROLE_LECTURER'));
        $user->setPassword($encoder->encodePassword($user, 'sacheend1234'));

        $manager->persist($user);


        $manager->flush();

    }
}
