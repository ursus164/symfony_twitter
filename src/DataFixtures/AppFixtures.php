<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// class responsible for loading specific type of dummy data
class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
        // field visibiility was added and the nPHP will automatically add field with that name to AppFixtures class
    ) {}

    // symfony calls the method below
    public function load(ObjectManager $manager): void
    {

        $user1 = new User();
        $user1->setEmail('test@example.com');
        $user1->setPassword(
            // available because dependency is injected
            $this->userPasswordHasher->hashPassword(
                $user1,
                '12345678'
            )
        );
        $user2 = new User();
        $user2->setEmail('patrykos@example.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '12345678'
            )
        );
        $manager->persist($user1);
        $manager->persist($user2);


        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to Poland!');
        $microPost1->setText('Polska Gurrom!!!!');
        $microPost1->setCreatedAt(new DateTime());

        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to US');
        $microPost2->setText('USA DOWN!!!!');
        $microPost2->setCreatedAt(new DateTime());

        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Welcome to GERMANY');
        $microPost3->setText('GERMANY MIDDLE!!!!');
        $microPost3->setCreatedAt(new DateTime());

        $manager->persist($microPost3);

        $manager->flush();
    }
}
