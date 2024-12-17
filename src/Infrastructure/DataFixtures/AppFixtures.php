<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        /*for ($i = 1;$i <= 20;$i++)
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

            $manager->persist($article);
        }

        $manager->flush();*/
    }
}
