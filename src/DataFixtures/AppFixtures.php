<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// class responsible for loading specific type of dummy data
class AppFixtures extends Fixture
{
    // symfony calls the method below
    public function load(ObjectManager $manager): void
    {
        $microPost1 = new MicroPost();
        $microPost1 -> setTitle('Welcome to Poland!');
        $microPost1 -> setText('Polska Gurrom!!!!');
        $microPost1 -> setCreatedAt(new DateTime());

        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2 -> setTitle('Welcome to US');
        $microPost2 -> setText('USA DOWN!!!!');
        $microPost2 -> setCreatedAt(new DateTime());

        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3 -> setTitle('Welcome to GERMANY');
        $microPost3 -> setText('GERMANY MIDDLE!!!!');
        $microPost3 -> setCreatedAt(new DateTime());

        $manager->persist($microPost3);

        $manager->flush();
    }
}
