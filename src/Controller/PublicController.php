<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Proverbe;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Panier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\PanierRepository;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Proverbe $proverbe) : Response
    {
        $message = $proverbe->getMessage();
        return $this->render('public/index.html.twig', [
            'title'     => 'La Boutique.',
            'proverbe'  => $message
        ]);
    }

    /**
     * @Route("/mentions_legales", name="mentions", methods={"GET"})
     */
    public function mentions() : Response
    {
        return $this->render('public/mentions.html.twig', [ 'title' => 'Mentions Legales']);
    }

    /**
     * @Route("/produits/categorie/{cat}", name="produits_categorie", methods={"GET"})
     */
    public function produits_categorie(ProduitRepository $produit_repository, CategorieRepository $categorie_repository, $cat)
    {
        $category = $categorie_repository->findOneBy(['libelle' => $cat]);
        $produits = $produit_repository->findBy(['categorie' => $category]);
        return $this->render('public/produits_cat.html.twig', [
            'title' => 'Nos ' . $cat . 's',
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/produits/{cat}", name="produits_cat", methods={"GET"})
     */
    public function produits_cat(ProduitRepository $produit_repository, $cat)
    {

        $produits = $produit_repository->findBy(['categorie' => $cat]);
        return $this->render('public/produits_cat.html.twig', [ 
            'title'     => 'Nos Produits',
            'produits'  => $produits
            ]);
    }

    /**
     * @Route("/produits", name="produits", methods={"GET"})
     */
    public function produits(ProduitRepository $produit_repository)
    {
        $produits = $produit_repository->findAll();
        return $this->render('public/produits.html.twig', [
            'title'     => 'Tous nos produits',
            'produits'  => $produits
        ]);
    }

    /**
     * @Route("/ajout_panier", name="ajout_panier", methods={"POST"})
     */
    public function ajoutPanier(Request $request, ProduitRepository $produit_repository)
    {
        $utilisateur = $this->getUser();
        $article = $produit_repository->find($request->request->get('id'));
        $date = new \DateTime();
        $panier = new Panier;
        // dump($utilisateur, $date, $article, $panier);
        $panier->setClient($utilisateur);
        $panier->setProduit($article);
        $panier->setQuantite($request->request->get('quantite'));
        $panier->setDatepanier($date);
        // dd($panier);
        $em = $this->getDoctrine()->getManager();
        $em->persist($panier);
        $em->flush();
        return $this->redirectToRoute('produits');
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panier(PanierRepository $panier_repository)
    {
        $paniers = $panier_repository->findByClient($this->getUser());

        return $this->render('public/panier.html.twig', [
            'title'     => 'Mon Panier',
            'paniers'    => $paniers
        ]);
    }
}
