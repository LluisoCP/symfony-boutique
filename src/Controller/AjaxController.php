<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PanierRepository;

class AjaxController extends AbstractController
{
    /**
     * @Route("/supprimePanier", name="supprimePanier", methods={"POST"})
     */
    public function supprimePanier(Request $request, PanierRepository $panier_repository)
    {
        $article = $panier_repository->find($request->request->get('id'));
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        return new Response('Produit supprimé');
    }

    /**
     * @Route("/modifiePanier", name="modifiePanier", methods={"POST"})
     */
    public function modifiePanier(Request $request, PanierRepository $panier_repository)
    {
        $article = $panier_repository->find($request->request->get('id'));
        $quantite = $request->request->get('q');
        $article->setQuantite($quantite);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return new Response('Quantité Modifié.');
    }

}
