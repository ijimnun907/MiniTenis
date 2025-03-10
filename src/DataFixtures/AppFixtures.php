<?php

namespace App\DataFixtures;

use App\Entity\Socio;
use App\Factory\PartidoFactory;
use App\Factory\SocioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        SocioFactory::createMany(100, [
            'clave' => $this->passwordHasher->hashPassword(
                new Socio(),
                'prueba'
            )
        ]);

        PartidoFactory::createMany(10);

        $manager->flush();
    }
}
