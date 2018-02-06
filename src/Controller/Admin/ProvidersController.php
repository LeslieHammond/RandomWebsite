<?php
// src/Controller/Admin/ProvidersController.php
namespace App\Controller\Admin;

// Entities
use App\Entity\Provider;

// Forms
use App\Form\ProviderType;

// Dependencies
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProvidersController extends Controller
{

    /**
     * @Route("/providers", name="admin_providers_index")
     */
    public function index()
    {
        return $this->render('admin/providers/index.html.twig');
    }

    /**
     * @Route("/admin/providers/table", name="admin_providers_table")
     */
    public function table()
    {
        $repository = $this->getDoctrine()->getRepository(Provider::class);

        return $this->render('admin/providers/table.html.twig', [
            'providers' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/provider/{id}", name="admin_providers_provider")
     */
    public function provider(Request $request, Provider $provider)
    {
        $form = $this->createForm(ProviderType::class, $provider);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $provider = $form->getData();

            $em->flush();
        }

        return $this->render('admin/providers/provider/index.html.twig', [
            'form'     => $form->createView(),
            'provider' => $provider
        ]);
    }

}
