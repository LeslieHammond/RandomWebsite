<?php
// src/Service/Crawlers/AmazonEs.php
namespace App\Service\Crawlers;

use Symfony\Component\DomCrawler\Crawler;

class AmazonEs
{
    private $crawler;
    private $url;

    public function __construct($url)
    {
        $html          = file_get_contents('http://' . $url);
        $this->crawler = new Crawler($html);

        $this->url = $url;
    }

    public function getTitle()
    {
        $title = null;

        foreach ($this->crawler->filter('span#productTitle')->eq(0) as $domElement)
        {
            $title = trim($domElement->nodeValue);
        }

        return $title;
    }

    public function getPrice()
    {
        $price = null;

        foreach ($this->crawler->filter('td.a-span12.a-color-secondary.a-size-base')->eq(0) as $domElement)
        {
            $exp   = explode('#', $domElement->nodeValue);
            $price = trim($exp[0]);

            // remove everything but 0-9 and ,
            $price = preg_replace('/[^0-9,]/', '', $price);

            $price = str_replace(',', '.', $price);
        }

        return $price;
    }

    public function getImage()
    {
        $image = null;

        foreach ($this->crawler->filter('img#landingImage')->extract('src') as $domElement)
        {
            $image = trim($domElement);
        }

        return $image;
    }

}
