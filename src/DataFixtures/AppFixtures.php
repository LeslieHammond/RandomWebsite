<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Provider;
use App\Entity\ProviderCrawler;
use App\Entity\ProviderTags;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $provider = new Provider();
    $provider->setName('AmazonEs');
    $provider->setDomain('www.amazon.es');
    $manager->persist($provider);

    $providerCrawler = new ProviderCrawler();
    $providerCrawler->setService('AmazonEs');
    $providerCrawler->setProvider($provider);
    $manager->persist($providerCrawler);

    $providerTags = new ProviderTags();
    $providerTags->setTag('tag');
    $providerTags->setValue('maestr-21');
    $providerTags->setProvider($provider);
    $manager->persist($providerTags);

    $providerTags = new ProviderTags();
    $providerTags->setTag('utm-campaign');
    $providerTags->setValue('semana-santa');
    $providerTags->setProvider($provider);
    $manager->persist($providerTags);

    $providerTags = new ProviderTags();
    $providerTags->setTag('utm-source');
    $providerTags->setValue('email');
    $providerTags->setProvider($provider);
    $manager->persist($providerTags);

    $provider = new Provider();
    $provider->setName('www.pccomponentes.com');
    $provider->setDomain('www.pccomponentes.com');
    $manager->persist($provider);

    $providerTags = new ProviderTags();
    $providerTags->setTag('tag');
    $providerTags->setValue('maestr-21');
    $providerTags->setProvider($provider);
    $manager->persist($providerTags);

    $provider = new Provider();
    $provider->setName('www.amazon.com');
    $provider->setDomain('www.amazon.com');
    $manager->persist($provider);

    $user = new User();
    $user->setUsername('admin');
    $user->setPassword('$2y$13$1L33HvZfPrQNsCK.znJVeOzp7f6D9HJTymF5DNIjXjRRFrGacJXVe');
    $user->setIsActive(true);
    $manager->persist($user);

    $manager->flush();
  }
}
