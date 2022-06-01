<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Post;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'Irina123456'
        );
        $user->setPassword($hashedPassword);
        $user->setEmail('Irina@mail.ru');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setContent("Контент ");
            $post->setPhoto("/img/blog-img/");
            $post->setHeading("Заголовок");
            $post->setViews(0);
            $post->setDate(new \DateTime());

            $manager->persist($post);
        }
        $manager->flush();
    }
}
