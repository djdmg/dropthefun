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

    #[Route('/fr/articles/{page}', name: 'blog_indexfr2')]
    public function blog_index2(BlogPostApiClient $apiClient,int $page): Response
    {
        $allPosts=$apiClient->getOnlineBlogPosts($page,5);

        ;
        return $this->render('index/indexFR.html.twig', [
            'articles' => $allPosts->getData(), 'pagination' => $allPosts->getPagination()
        ]);
    }


    #[Route('/en/articles/{page}', name: 'blog_index2')]
    public function blog_index2fr(BlogPostApiClient $apiClient,int $page): Response
    {
        $allPosts=$apiClient->getOnlineBlogPosts($page,5);

      ;
        return $this->render('index/index.html.twig', [
            'articles' => $allPosts->getData(), 'pagination' => $allPosts->getPagination()
        ]);
    }

    #[Route('/en/', name: 'blog_index')]
    public function blog_index(BlogPostApiClient $apiClient): Response
    {
        $allPosts=$apiClient->getOnlineBlogPosts(1,5);


        return $this->render('index/index.html.twig', [
            'articles' => $allPosts->getData(), 'pagination' => $allPosts->getPagination()
        ]);
    }

    #[Route('/fr/', name: 'blog_index_fr')]
    public function indexfr(BlogPostApiClient $apiClient): Response
    {
        $allPosts=$apiClient->getOnlineBlogPosts(1,5);

        return $this->render('index/indexFR.html.twig', [
            'articles' => $allPosts->getData(),'pagination' => $allPosts->getPagination(),
        ]);
    }









}
