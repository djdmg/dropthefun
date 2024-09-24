<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;

class BlogPostController extends AbstractController
{
    #[Route('en/article/{WebTitleEN}', name: 'blog_article')]
    public function article(BlogPostApiClient $apiClient, CacheInterface $cache, string $WebTitleEN): Response
    {
        $article = $apiClient->getPost($WebTitleEN, $cache); // Pass the cache as the second argument

        return $this->render('blog_post/blogPost.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/fr/article/{WebTitleFR}', name: 'blog_article_fr')]
    public function articleFR(BlogPostApiClient $apiClient, CacheInterface $cache, string $WebTitleFR): Response
    {
        $article = $apiClient->getPostFR($WebTitleFR, $cache); // Pass the cache as the second argument

        return $this->render('blog_post/blogPostFR.html.twig', [
            'article' => $article,
        ]);
    }
}
