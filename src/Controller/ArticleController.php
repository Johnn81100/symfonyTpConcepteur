<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
   
    #[Route('/article/all', name: 'app_article_all')]
    public function showArticles(ArticleRepository $articleRepository,): Response
    {
        $allArticles= $articleRepository->findAll();
      

        return $this->render('article/index2.html.twig', [
            'articles'=> $allArticles            
        ]);
    }
    #[Route('/article/show/{id}', name: 'app_article_id')]
    public function showOneArticle(ArticleRepository $articleRepository, $id): Response
    {
        
        $article= $articleRepository->find($id);
     
        return $this->render('article/app_article_all.html.twig', [
            'article'=> $article            
        ]);
    }
    #[Route('/article/add', name:'app_article_add')]
    public function addArticle( ): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);
       
     
        return $this->render('article/app_article_add.html.twig', [
                      'form'=>$form->createView()
        ]);
    }
}
