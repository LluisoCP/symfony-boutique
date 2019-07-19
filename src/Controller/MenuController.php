<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Repository\CategorieRepository;

class MenuController extends AbstractController
{

    public function navbar(AuthorizationCheckerInterface $auth, CategorieRepository $categorie)
    {
        if ($auth->isGranted("ROLE_ADMIN"))
        {
            $liens = [
                ['href' => 'clients',       'lib' => 'Clients',         'icon' => 'fas fa-user'],
                ['href' => 'ajout_produit',  'lib' => 'Ajout Produit',   'icon' => 'fas fa-plus-circle'],
                ['href' => 'app_logout',    'lib' => 'Logout',          'icon' => 'fas fa-power-off'],
                ['href' => 'produits',      'lib' => 'Produits',        'icon' => 'fab fa-product-hunt']


            ];
        }
        else if ($auth->isGranted("ROLE_USER"))
        {
            $liens = [
                ['href' => 'panier',        'lib' => 'Mon Panier',      'icon' => 'fas fa-shopping-basquet'],
                ['href' => 'app_logout',    'lib' => 'Logout',          'icon' => 'fas fa-power-off'],
                ['href' => 'produits',      'lib' => 'Produits',        'icon' => 'fab fa-product-hunt'],
                // ['href' => 'contact',       'lib' => 'Contact',         'icon' => 'fas fa-plus-circle']
            ];
        }
        else
        {
            $liens = [
                ['href' => 'app_login',     'lib' => 'Login',           'icon' => 'fas fa-sign-in-alt'],
                ['href' => 'app_register',  'lib' => 'Sign Up',         'icon' => 'fas fa-user-plus'],
                ['href' => 'produits',      'lib' => 'Produits',        'icon' => 'fab fa-product-hunt'],
                ['href' => 'app_logout',    'lib' => 'Logout',          'icon' => 'fas fa-power-off']
                // ['href' => 'contact',       'lib' => 'Contact',         'icon' => 'fas fa-plus-circle']

            ];
        }

        $categories = $categorie->findAll();
        return $this->render('menu/navbar.html.twig', [
            'liens'         => $liens,
            'categories'    => $categories
            
        ]);
    }
}
