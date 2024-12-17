<?php

namespace App\Application\Service;

use App\Domain\Entity\Article;
use App\Infrastructure\Persistence\Doctrine\Repository\Article\ArticleRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleService
{
    public function __construct(private ArticleRepository $articleRepository,
                                private SluggerInterface $slugger)
    {
    }

    public function getAllActiveArticles():array
    {
        return $this->articleRepository->getActiveArticles();
    }

    public function getOneArticle(string $uniqueName): ?Article
    {
        $article = $this->articleRepository->getArticleByUniqueCode($uniqueName);

        if (!$article)
        {
            return null;
        }

        $amountViews = $article->getAmountViews() + 1;

        $article->setAmountViews($amountViews);

        $this->articleRepository->save($article,true);

        return $article;

    }

    public function addArticles(): void
    {
        $articlesAlreadyExists = $this->articleRepository->getActiveArticles();

        if (count($articlesAlreadyExists) < 10)
        {
            for ($i = 1;$i <= 20;$i++)
            {
                $title = "новость $i";
                $currentDateTime = new \DateTimeImmutable();
                $article = new Article();
                $article->setTitle($title);
                $article->setUniqueCode($this->slugger->slug($title) . "-" . uniqid());
                $article->setDescription("description of title number $i");
                $article->setAmountViews(0);
                $article->setCreatedDate($currentDateTime->modify("-1 day")->modify("+$i hour"));
                $article->setActivity(true);

                if ($i > 10)
                {
                    $article->setActivity(false);
                }

                $this->articleRepository->save($article,true);
            }
        }

    }

}
