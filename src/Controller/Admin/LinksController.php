<?php
// src/Controller/Admin/LinksController.php
namespace App\Controller\Admin;

// Entities
use App\Entity\Link;

// Forms
use App\Form\LinkType;

// Services
use App\Service\Links;

// Dependencies
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LinksController extends Controller
{
    /**
     * @Route("/admin/links", name="admin_links_index")
     */
    public function index(Request $request, Links $links)
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $link = $form->getData();

            $links->add($link);

            return $this->redirectToRoute('admin_links_index');
        }

        return $this->render('admin/links/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/links/table", name="admin_links_table")
     */
    public function table()
    {
        $repository = $this->getDoctrine()->getRepository(Link::class);

        return $this->render('admin/links/table.html.twig', [
            'links' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/links/edit/{id}/{status}", name="admin_links_edit")
     */
    public function edit($id, $status, UrlGeneratorInterface $router)
    {
        $link = $this->getDoctrine()
            ->getRepository(Link::class)
            ->find($id);

        $response = new JsonResponse();

        if (empty($link))
        {
            $response->setData([
                'message' => 'No changes applied.',
                'type'    => 'information',
                'url'     => null
            ]);
        }
        else
        {
            $em = $this->getDoctrine()->getManager();

            $link->setActive($status);

            $em->flush();

            if ($status == 1)
            {
                $str    = 'activated';
                $status = 0;
            }
            else
            {
                $str    = 'disabled';
                $status = 1;
            }

            $response->setData([
                'message' => '"' . $link->getUrl() . '" ' . $str . ' successfully.',
                'status'  => $status,
                'type'    => 'success',
                'url'     => $router->generate('admin_links_edit', [
                    'id'     => $id,
                    'status' => $status
                ])
            ]);
        }

        return $response;
    }

}
