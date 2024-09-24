<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;

class CategoryController extends AbstractController
{
    #[Route('en/category/{category}', name: 'blog_article_by_category')]
    public function articleByCategory(BlogPostApiClient $apiClient, CacheInterface $cache, string $category): Response
    {
        $articles = $apiClient->getPostByCategory($category, 1, 5, $cache);
        $articles2 = $articles->getData();

        return $this->render('index/index.html.twig', [
            'articles' => $articles2,
            'category' => $articles2[0]->getCategorisation(),
            'pagination' => $articles->getPagination(),
        ]);
    }

    #[Route('fr/category/{category}', name: 'blog_article_by_category_fr')]
    public function articleByCategoryFr(BlogPostApiClient $apiClient, CacheInterface $cache, string $category): Response
    {
        $articles = $apiClient->getPostByCategoryFr($category, 1, 5, $cache);
        $articles2 = $articles->getData();

        return $this->render('index/indexFR.html.twig', [
            'articles' => $articles2,
            'category' => $articles2[0]->getCategorisation(),
            'pagination' => $articles->getPagination(),
        ]);
    }

    #[Route('en/category/{category}/{page}', name: 'blog_article_by_category2')]
    public function articleByCategory2(BlogPostApiClient $apiClient, CacheInterface $cache, string $category, int $page): Response
    {
        $articles = $apiClient->getPostByCategory($category, $page, 5, $cache);
        $articles2 = $articles->getData();

        return $this->render('index/index.html.twig', [
            'articles' => $articles2,
            'category' => $articles2[0]->getCategorisation(),
            'pagination' => $articles->getPagination(),
        ]);
    }

    #[Route('fr/category/{category}/{page}', name: 'blog_article_by_categoryFr2')]
    public function articleByCategorFr2(BlogPostApiClient $apiClient, CacheInterface $cache, string $category, int $page): Response
    {
        $articles = $apiClient->getPostByCategoryFr($category, $page, 5, $cache);
        $articles2 = $articles->getData();

        return $this->render('index/indexFR.html.twig', [
            'articles' => $articles2,
            'category' => $articles2[0]->getCategorisation(),
            'pagination' => $articles->getPagination(),
        ]);
    }
}
