<?php
// src/Controller/Front/IndexController.php
namespace App\Controller\Front;

// Entities
use App\Entity\Link;

// Forms
use App\Form\LinkType;

// Services
use App\Service\Links;

// Dependencies
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="front_index")
     */
    public function index(Links $links)
    {
        $link = $links->getRandomLink();
        
        return $this->render('front/index/index.html.twig', [
            'link' => $link
        ]);
    }

    /**
     * @Route("/redirect_page/{id}", name="front_redirectPage");
     */
    public function redirectPage(Link $link)
    {
        return $this->redirect($link->getFullUrl());
    }

    /**
     * @Route("/add_link", name="front_addLink")
     */
    public function addLink(Request $request)
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $link = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($link);

            try
            {
                $em->flush();

                $flashMessage->add('success', $link->getUrl() . ' added successfully.');
            }
            catch (\Exception $e)
            {
                $flashMessage->add('danger', $link->getUrl() . ' already exists.');
            }
        }

        return $this->render('front/index/addLink.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
