<?php

namespace App\DataFixtures;
use App\Entity\SocialNetworks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class SocialNetworksFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $facebook= new socialNetworks();
        $facebook->setName("facebook");
        $facebook->setIcon("fa-facebook");
        $facebook->setSocialNetworksUrl("https://www.facebook.com");
        $manager->persist($facebook);

        $twitter= new socialNetworks();
        $twitter->setName("twitter");
        $twitter->setIcon("fa-twitter");
        $twitter->setSocialNetworksUrl("https://twitter.com");
        $manager->persist($twitter);

        $linkedin= new socialNetworks();
        $linkedin->setName("linkedin");
        $linkedin->setIcon("fa-linkedin");
        $linkedin->setSocialNetworksUrl("https://www.linkedin.com");
        $manager->persist($linkedin);


        /*//$generator = FontAwesomeReader::create()
       for($i =0 ; $i <3 ; $i++){
           $socialNetworks = new SocialNetworks();
           $socialNetworks->setName(  $icons->name())
               ->setIcon(  $icons->icon);
           $manager->persist($socialNetworks);
       }*/


        $manager->flush();
    }
}
