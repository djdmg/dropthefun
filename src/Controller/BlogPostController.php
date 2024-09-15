<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogPostController extends AbstractController
{
    #[Route('en/article/{WebTitleEN}', name: 'blog_article')]
    public function article(BlogPostApiClient $apiClient,string $WebTitleEN): Response
    {
        $article=$apiClient->getPost($WebTitleEN);


        return $this->render('index/detail.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/fr/article/{WebTitleFR}', name: 'blog_article_fr')]
    public function articleFR(BlogPostApiClient $apiClient,string $WebTitleFR): Response
    {
        $article=$apiClient->getPostFR($WebTitleFR);

        return $this->render('index/detailFR.html.twig', [
            'article' => $article,
        ]);
    }
}
