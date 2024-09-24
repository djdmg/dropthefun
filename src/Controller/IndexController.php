<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class IndexController extends AbstractController
{
    #[Route('/', name: 'blog_index')]
    public function index(BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        $cacheKey = 'blog_posts_page_1_limit_5';

        $allPosts = $cache->get($cacheKey, function (ItemInterface $item) use ($apiClient) {
            $item->expiresAfter(1800); // 1800 secondes = 30 minutes
            return $apiClient->getOnlineBlogPosts(1, 5);
        });

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/fr/articles/{page}', name: 'blog_indexfr2')]
    public function blog_index2(BlogPostApiClient $apiClient, CacheInterface $cache, int $page): Response
    {
        $cacheKey = sprintf('blog_posts_fr_page_%d_limit_5', $page);

        $allPosts = $cache->get($cacheKey, function (ItemInterface $item) use ($apiClient, $page) {
            $item->expiresAfter(1800);
            return $apiClient->getOnlineBlogPosts($page, 5);
        });

        return $this->render('index/indexFR.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/en/articles/{page}', name: 'blog_index2')]
    public function blog_index2fr(BlogPostApiClient $apiClient, CacheInterface $cache, int $page): Response
    {
        $cacheKey = sprintf('blog_posts_en_page_%d_limit_5', $page);

        $allPosts = $cache->get($cacheKey, function (ItemInterface $item) use ($apiClient, $page) {
            $item->expiresAfter(1800);
            return $apiClient->getOnlineBlogPosts($page, 5);
        });

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/en/', name: 'index_principalgi')]
    public function blog_index(BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        $cacheKey = 'blog_posts_en_page_1_limit_5';

        $allPosts = $cache->get($cacheKey, function (ItemInterface $item) use ($apiClient) {
            $item->expiresAfter(1800);
            return $apiClient->getOnlineBlogPosts(1, 5);
        });

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/fr/', name: 'blog_index_fr')]
    public function indexfr(BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        $cacheKey = 'blog_posts_fr_page_1_limit_5';

        $allPosts = $cache->get($cacheKey, function (ItemInterface $item) use ($apiClient) {
            $item->expiresAfter(1800);
            return $apiClient->getOnlineBlogPosts(1, 5);
        });

        return $this->render('index/indexFR.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }
}
