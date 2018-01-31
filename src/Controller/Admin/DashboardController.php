<?php
// src/Controller/Admin/DashboardController.php
namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/admin", name="admin_dashboard_index")
     */
    public function index()
    {
        return $this->render('admin/dashboard/index.html.twig');
    }
}
