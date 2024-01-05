<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $searchTerm = $request->query->get('q', '');
        $articles = $articleRepository->searchArticles($searchTerm);

        return $this->render('search/index.html.twig', [
            'articles' => $articles,
            'searchTerm' => $searchTerm,
        ]);
    }
}
