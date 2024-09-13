<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index_principal')]
    public function index(): Response
    {
        return $this->redirectToRoute('blog_index');
    }

    #[Route('/en/', name: 'blog_index')]
    public function blog_index(BlogPostApiClient $apiClient): Response
    {
        $allPosts=$apiClient->getOnlineBlogPosts();
        
        return $this->render('index/index.html.twig', [
            'articles' => $allPosts,
        ]);
    }

    #[Route('/fr/', name: 'blog_index_fr')]
    public function indexfr(BlogPostApiClient $apiClient): Response
    {
        $allPosts=$apiClient->getOnlineBlogPosts();

        return $this->render('index/indexFr.html.twig', [
            'articles' => $allPosts,
        ]);
    }

    #[Route('/fr/tag/{tag}', name: 'blog_index_tag_fr')]
    public function tagfr(BlogPostApiClient $apiClient,string $tag): Response
    {
        $allPosts=$apiClient->getOnlineBlogPostsByTagFr($tag);

        return $this->render('index/indexFr.html.twig', [
            'articles' => $allPosts,
        ]);
    }

    #[Route('/en/tag/{tag}', name: 'blog_index_tag')]
    public function tag(BlogPostApiClient $apiClient,string $tag): Response
    {


        $allPosts=$apiClient->getOnlineBlogPostsByTag($tag);

        return $this->render('index/index.html.twig', [
            'articles' => $allPosts,
        ]);
    }



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

    #[Route('en/category/{category}', name: 'blog_article_by_category')]
    public function articleByCategory(BlogPostApiClient $apiClient,string $category): Response
    {
        $articles=$apiClient->getPostByCategory($category);


        return $this->render('index/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('fr/category/{category}', name: 'blog_article_by_category_fr')]
    public function articleByCategoryFr(BlogPostApiClient $apiClient,string $category): Response
    {
        $articles=$apiClient->getPostByCategoryFr($category);


        return $this->render('index/indexFr.html.twig', [
            'articles' => $articles,
        ]);
    }

}
