<?php
// src/Controller/Admin/BaseController.php
namespace App\Controller\Admin;

// Entities
use App\Entity\Provider;

// Dependencies
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BaseController extends Controller
{
    public function shortcuts()
    {
        return $this->render('admin/base/shortcuts.html.twig', [
            'pending' => 8
        ]);
    }

    public function providers($icon, $include, $path, $pathInfo, $route, $title, UrlGeneratorInterface $router)
    {
        $repository = $this->getDoctrine()->getRepository(Provider::class);

        $links = [];
        foreach ($repository->findAll() as $e)
        {
            $links[] = [
                'url'   => $router->generate('admin_providers_provider', [
                    'id' => $e->getId()
                ]),
                'value' => $e->getName()
            ];
        }

        return $this->render('admin/base/menu/entity.html.twig', [
            'links'    => $links,
            'icon'     => $icon,
            'include'  => $include,
            'path'     => $path,
            'pathInfo' => $pathInfo,
            'route'    => $route,
            'title'    => $title
        ]);
    }
}
