<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Frontpage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontpageController extends AbstractController
{
    #[Route(path: '/', name: 'app_frontpage')]
    public function __invoke(): Response
    {
        return $this->redirectToRoute('app_articles');
    }
}
