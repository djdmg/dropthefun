<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class IndexController extends AbstractController
{
    #[Route('/', name: 'blog_index')]
    public function index(BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        $allPosts = $apiClient->getOnlineBlogPosts(1, 5, $cache);

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/fr/articles/{page}', name: 'blog_indexfr2')]
    public function blog_index2(BlogPostApiClient $apiClient, CacheInterface $cache, int $page): Response
    {
        $allPosts = $apiClient->getOnlineBlogPosts($page, 5, $cache);

        return $this->render('index/indexFR.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/en/articles/{page}', name: 'blog_index2')]
    public function blog_index2fr(BlogPostApiClient $apiClient, CacheInterface $cache, int $page): Response
    {
        $allPosts = $apiClient->getOnlineBlogPosts($page, 5, $cache);

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/en/', name: 'index_principalgi')]
    public function blog_index(BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        $allPosts = $apiClient->getOnlineBlogPosts(1, 5, $cache);

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/fr/', name: 'blog_index_fr')]
    public function indexfr(BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        $allPosts = $apiClient->getOnlineBlogPosts(1, 5, $cache);

        return $this->render('index/indexFR.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }
}
