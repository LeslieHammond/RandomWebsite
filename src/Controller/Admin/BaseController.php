<?php
// src/Controller/Admin/BaseController.php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function shortcuts()
    {
        return $this->render('admin/base/shortcuts.html.twig', [
            'pending' => 8
        ]);
    }
}
