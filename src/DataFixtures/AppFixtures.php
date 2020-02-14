<?php

namespace App\DataFixtures;

use App\CarEstimation\ICarEstimation;
use App\Entity\Advert;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;
    private $priceEstimation;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface, ICarEstimation $iCarEstimation)
    {
        $this->passwordEncoder =  $userPasswordEncoderInterface;
        $this->priceEstimation = $iCarEstimation;
    }
    
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $advert = new Advert();
            $advert->setTitle($faker->word())
                ->setDescription($faker->text())
                ->setCity($faker->city())
                ->setCarYear($carYear = $faker->randomDigitNot(0))
                ->setNbKm($nbKm = $faker->numberBetween(1000, 150000))
                ->setNbDays($nbDays = $faker->randomDigitNot(0))
                ->setPrice($this->priceEstimation->estimate($carYear, $nbKm, $nbDays));
            $manager->persist($advert);
        }


        $user = new User();
        $user->setEmail('admin@admin.com')
            ->setLogin('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, "admin"));
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user'.$i.'@user.com')
                ->setLogin('user'.$i)
                ->setRoles(['ROLE_USER'])
                ->setPassword($this->passwordEncoder->encodePassword($user, "user".$i));

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
