<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\fablab;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        // $product = new Product();
        // $manager->persist($product);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'the_new_password'
        ));
        $contributor = new User();
        $contributor->setEmail('contributor@monsite.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor->setFirstName('Christophe');
        $contributor->setLastName('Mae');
        $contributor->setPassword($this->passwordEncoder->encodePassword(
            $contributor,
            'contributorpassword'
        ));

        $manager->persist($contributor);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstName('Christopher');
        $admin->setLastName('Persinet');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));
        $manager->persist($admin);


        $fablab = new Fablab();
        $fablab->setSiret(77568562100796);
        $fablab->setAddress('21 Rue Dieu-Lumière, 51100 Reims');
        $fablab->setCity('Reims');
        $fablab->setPhone('0326358060');
        $fablab->setMail('contact@ufcv.fr');
        $fablab->setName('UFCV');
        $fablab->setSchedule('Lundi au vendredi 9h-12h / 14h-17h');
        $fablab->setCategory('C.A.O');
        $manager->persist($fablab);


        $fablab2 = new Fablab();
        $fablab2->setSiret(34270750200502);
        $fablab2->setAddress('7 bis Avenue Robert Schuman, 51100 Reims');
        $fablab2->setCity('Reims');
        $fablab2->setPhone('0326793570');
        $fablab2->setMail('contact-reims@cesi.fr');
        $fablab2->setName('Campus CESI');
        $fablab2->setSchedule('Lundi au vendredi 8h-17h');
        $fablab2->setCategory('C.A.O');
        $manager->persist($fablab2);


        $manager->flush();
    }
}
