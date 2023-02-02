<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    public function __construct(private ProductRepository $productRepository)
    {

    }

    private array $prodFictifs = [
        'bell jar' => ["nom" => "bell jar", "description" => "descrp de la bell jar", "prix" => 10, "image" => ".././images/bell_jar.jpg"],
        'pomme d\'amour' => ["nom" => "pomme d'amour", "description" => "descrp de la pomme d'amour", "prix" => 20, "image" => ".././images/pomme_d_amour.jpg"],
    ];

    #[Route('/product/{slug}', name: 'product.detail')]
    public function detail(string $slug):Response
    {
        $titre = "detail du produit : ";
        return $this->render('product/detail.html.twig', ['titre' => $titre, 'product' => $this->productRepository->findAll()["slug" == $slug]]);

    }

    // With the list prodFictifs
    // #[Route('/products', name: 'product.index')]
    // public function index():Response
    // {
    //     return $this->render('index.html.twig', ['products' => $this->prodFictifs]);
    // }
  
    // #[Route('/products', name: 'product.index')]
    // public function index():Response
    // {   
    //     return $this->render('product/index.html.twig', ['products' => $this->productRepository->findAll()]);
    // }
  
    #[Route('/products/page/{nbPage}', name: 'product.index')]
    public function indexPage(int $nbPage):Response
    {   

        $nbProduct = $this->productRepository->nbTotalProduct();
        $infoPage = $this->productRepository->select12Page($nbPage);

        return $this->render('product/index.html.twig', ['nbProduct' => $nbProduct, 'products' => $infoPage]);
    }

}
