<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends Controller
{

    /**
     * @Route("/lucky/number/{max}")
     */
    public function number($max = 100)
    {
        $number = mt_rand(0, $max);

        return $this->render('lucky/number.html.twig', [
            'number' => $number
        ]);
    }
}
