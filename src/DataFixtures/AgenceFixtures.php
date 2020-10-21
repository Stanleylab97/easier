<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Agence;

class AgenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $agence = new Agence();
         $agence->setLibelle("Agence Godomey");
         $agence->setLon(1.58948);
         $agence->setLat(6.2548);
         $manager->persist($agence);
         $manager->flush();
    }
}
