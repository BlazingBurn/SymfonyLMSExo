<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{

    public function __construct(private ProductRepository $productRepository)
    {

    }

    #[Route('/', name: 'homepage.index')]
    public function index():Response
    {
        return $this->render('homepage/index.html.twig', ['products' => $this->productRepository->select3Random()]);
    }

}