<?php

namespace App\Presentation\Http\App\Controller\Frontpage;


use App\Application\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    public function __construct(private ArticleService $articleService)
    {
    }

    #[Route('/articles', name: 'app_articles',methods: ['GET'])]
    public function getAllActiveArticles(): Response
    {
        return $this->render('article/main-page.html.twig', [
            'articles' => $this->articleService->getAllActiveArticles(),
        ]);
    }

    #[Route('/articles/{slug}', name: 'app_get_article',methods: ['GET'])]
    public function getArticleByUniqueCode(string $slug): Response
    {
        $article = $this->articleService->getOneArticle($slug);

        if ($article === null)
        {
            return $this->redirectToRoute('app_article_not_found_page');
        }

        return $this->render('article/article-page.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/articles/not-found-page', name: 'app_article_not_found_page',methods: ['GET'],priority: 2)]
    public function getArticleNotFound(): Response
    {
        return $this->render('article/article-notfound-page.html.twig', [
        ]);
    }

    #[Route('/add-article', name: 'app_add_article',methods: ['GET'],priority: 2)]
    public function addArticle(): Response
    {
        $this->articleService->addArticles();

        return $this->redirectToRoute('app_articles');
    }









}
