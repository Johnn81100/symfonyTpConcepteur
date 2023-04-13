<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    #[Route('/article/all', name: 'app_article_all')]
    public function showArticles(ArticleRepository $articleRepository,): Response
    {
        $allArticles= $articleRepository->findAll();
        dump($allArticles);

        return $this->render('article/index2.html.twig', [
            'articles'=> $allArticles            
        ]);
    }
}
