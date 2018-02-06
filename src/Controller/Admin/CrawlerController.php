<?php
// src/Controller/Admin/CrawlerController.php
namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    /**
     * @Route("/admin/crawler/index", name="admin_crawler_index")
     */
    public function index()
    {
        $html    = @file_get_contents('https://www.amazon.es/dp/B0055ZGHO8');
        $crawler = new Crawler($html);

        $title = null;

        foreach ($crawler->filter('span#productTitle')->eq(0) as $domElement)
        {
            $title = trim($domElement->nodeValue);
        }

        echo $title;exit;

        $price = null;

        foreach ($crawler->filter('td.a-span12.a-color-secondary.a-size-base')->eq(0) as $domElement)
        {
            $exp   = explode('#', $domElement->nodeValue);
            $price = trim($exp[0]);
        }

        $img = null;

        foreach ($crawler->filter('img#landingImage')->extract('src') as $domElement)
        {
            $img = trim($domElement);
        }
        exit;

        echo $title . ': ' . $price;

        exit;
    }
}
