<?php
// src/Service/Links.php
namespace App\Service;

// Entities
use App\Entity\Link;
use App\Entity\LinkDetails;
use App\Entity\Provider;

// Services
use App\Service\LinkSanitizer;

// Dependencies
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class Links
{

    private $em;
    private $flashBag;

    public function __construct(EntityManagerInterface $em, FlashBagInterface $flashBag)
    {
        $this->em       = $em;
        $this->flashBag = $flashBag;
    }

    public function add($link)
    {
        $domain = $this->validateLink($link);

        $this->insertLink($link, $domain);
    }

    private function validateLink(&$link)
    {
        try {
            $linkSanitizer = new LinkSanitizer($link->getUrl());

            $url = $linkSanitizer->sanitize();

            $link->setUrl($url);

            return $linkSanitizer->getDomain();
        }
        catch (\Exception $e)
        {
            $this->flashBag->add('danger', '"' . $link->getUrl() . '" ' . $e->getMessage() . '.');

            return null;
        }
    }

    private function insertLink($link, $domain)
    {
        $this->em->persist($link);

        try
        {
            $provider = $this->checkProvider($domain);

            $this->em->persist($this->createLinkDetails($link));

            $link->setProvider($provider);

            $this->em->flush();

            $this->flashBag->add('success', '"' . $link->getUrl() . '" added successfully.');
        }
        catch (\Exception $e)
        {
            $this->flashBag->add('danger', '"' . $link->getUrl() . '" already exists.');
        }
    }

    private function createLinkDetails($link)
    {
        $linkDetails = new LinkDetails();

        $linkDetails->setLink($link);

        return $linkDetails;
    }

    public function checkProvider($domain)
    {
        $repository = $this->em->getRepository(Provider::class);

        $provider = $repository->findOneBy(['domain' => $domain]);

        if (empty($provider))
        {
            $provider = new Provider();

            $provider->setName($domain);
            $provider->setDomain($domain);

            $this->em->persist($provider);
        }

        return $provider;
    }

    public function getRandomLink()
    {
        $max = $this->em
            ->getRepository(Link::class)
            ->countActive();

        $link = $this->em
            ->getRepository(Link::class)
            ->randomLink($max);

        return $link;
    }

}
