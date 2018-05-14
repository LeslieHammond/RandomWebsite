<?php
// src/Controller/Front/ApiController.php
namespace App\Controller\Front;

// Entities
use App\Entity\Link;

// Services
use App\Service\Links;

// Dependencies
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
  /**
  * @Route("/api", name="front_index")
  */
  public function getLink(Links $links, Request $request) {
    print_r($request);exit;

    $link = $links->getRandomLink();

    return $this->render('front/index/index.html.twig', [
      'link' => $link
    ]);
  }

}
