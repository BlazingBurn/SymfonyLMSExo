<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class SearchController extends AbstractController
{

    public function __construct(private RequestStack $requestStack, private ProductRepository $productRepository)
    {

    }

    #[Route('/search', name: 'search.index')]
    public function index():Response
    {

        $type = SearchType::class;

        $form = $this->createForm($type);

        $form->handleRequest($this->requestStack->getCurrentRequest());
        
        if($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('search.result', ['research' => $form->getData()->getName()]);
        }

        return $this->render('search/search.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/search/result/{research}', name: 'search.result')]
    public function searchResult(string $research): Response
    {
        $products = $this->productRepository->search($research);

        return $this->render('search/index.html.twig', [
            'products' => $products,
        ]);
    }

}
