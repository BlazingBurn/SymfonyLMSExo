<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    private array $prodFictifs = [
        'bell jar' => ["nom" => "bell jar", "description" => "descrp de la bell jar", "prix" => 10, "image" => ".././images/bell_jar.jpg"],
        'pomme d\'amour' => ["nom" => "pomme d'amour", "description" => "descrp de la pomme d'amour", "prix" => 20, "image" => ".././images/pomme_d_amour.jpg"],
    ];

    #[Route('/product/{productName}', name: 'product.detail')]
    public function detail(string $productName):Response
    {
        $titre = "detail du produit : ";

        if (array_key_exists($productName, $this->prodFictifs)) {
            return $this->render('product/detail.html.twig', ['titre' => $titre, 'product' => $this->prodFictifs[$productName]]);
        } else {
            return $this->render('error.html.twig');
        }

    }

    #[Route('/products', name: 'product.index')]
    public function index():Response
    {
        return $this->render('index.html.twig', ['products' => $this->prodFictifs]);
    }

}
