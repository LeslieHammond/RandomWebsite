<?php
// src/Service/Crawler.php
namespace App\Service;

// Entities

// Dependencies
use Doctrine\ORM\EntityManagerInterface;

class Crawler
{

    private $em;
    private $links;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em    = $em;
        $this->links = [];
    }

    public function addLink($link)
    {
        $this->links[] = $link;
    }

    public function crawl()
    {
        foreach ($this->links as $link)
        {
            $providerCrawler = $link->getProvider()->getProviderCrawler();

            $linkDetails = $link->getLinkDetails();

            if ($providerCrawler != null)
            {
                $service = "App\\Service\\Crawlers\\" . $providerCrawler->getService();
                $c       = new $service($link->getUrl());

                $linkDetails->setTitle($c->getTitle());
                $linkDetails->setPrice($c->getPrice());
                $linkDetails->setImage($c->getImage());
            }

            $linkDetails->setUpdateDate(new \DateTime('now'));

            $this->em->flush($linkDetails);
        }
    }

    private function classes()
    {
        $c = new AmazonEs();
    }

}
