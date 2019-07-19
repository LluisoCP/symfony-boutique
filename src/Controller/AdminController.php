<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Services\MonUpload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ClientRepository;
use App\Form\ProduitType;

/**
 * @isGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/ajout_produit", name="ajout_produit")
     */
    public function ajoutProduit(Request $request, MonUpload $up)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        // $form = $this->createFormBuilder($produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $file = $produit->getImage();
            // $file = $form['image']->getData();
            $filename = $up->upload($file);
            $produit->setImage($filename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('index');
        }


        return $this->render('admin/ajoutProduit.html.twig', [
            'title' => 'Ajouter un produit',
            'form'  => $form->createView()
        ]);
    }
    /**
     * @Route("/clients", name="clients")
     */
    public function clients(ClientRepository $client_repository)
    {
        $clients = $client_repository->findAll();
        return $this->render('admin/clients.html.twig', [
            'title'     => 'Liste de Clients',
            'clients'   => $clients
        ]);
    }
}
