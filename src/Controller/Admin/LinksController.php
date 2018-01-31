<?php
// src/Controller/Admin/LinksController.php
namespace App\Controller\Admin;

// Entities
use App\Entity\Link;
use App\Entity\Provider;

// Forms
use App\Form\LinkType;

// Services
use App\Service\LinkSanitizer;

// Dependencies
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LinksController extends Controller
{
    /**
     * @Route("/admin/links/index", name="admin_links_index")
     */
    public function index(Request $request)
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $link = $form->getData();

            $domain = $this->validateLink($link);

            $this->insertLink($link, $domain);
        }

        return $this->render('admin/links/index.html.twig', [
            'form' => $form->createView()
        ]);
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
            $this->addFlash('danger', '"' . $link->getUrl() . '" ' . $e->getMessage() . '.');

            return null;
        }
    }

    private function insertLink($link, $domain)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($link);

        try
        {
            $provider = $this->checkProvider($domain);

            $link->setProvider($provider);

            $em->flush();

            $this->addFlash('success', '"' . $link->getUrl() . '" added successfully.');

            return $this->redirectToRoute('admin_links_index');
        }
        catch (\Exception $e)
        {
            $this->addFlash('danger', '"' . $link->getUrl() . '" already exists.');
        }
    }

    public function checkProvider($domain)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository(Provider::class);

        $provider = $repository->findOneBy(['domain' => $domain]);

        if (empty($provider))
        {
            $provider = new Provider();

            $provider->setName($domain);
            $provider->setDomain($domain);

            $em->persist($provider);
        }

        return $provider;
    }

    /**
     * @Route("/admin/links/list", name="admin_links_list")
     */
    function list(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Link::class);

        return $this->render('admin/links/list.html.twig', [
            'links' => $repository->findAll()
        ]);
    }

}
