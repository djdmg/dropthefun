<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TagController extends AbstractController
{
    #[Route('/fr/tag/{tag}', name: 'blog_index_tag_fr')]
    public function tagfr(BlogPostApiClient $apiClient,string $tag): Response
    {
        $allPosts=$apiClient->getOnlineBlogPostsByTagFr($tag,1,5);

        return $this->render('index/indexFR.html.twig', [
            'articles' => $allPosts->getData(),'tag' => $tag, 'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/en/tag/{tag}', name: 'blog_index_tag')]
    public function tag(BlogPostApiClient $apiClient,string $tag): Response
    {


        $allPosts=$apiClient->getOnlineBlogPostsByTag($tag,1,5);

        return $this->render('index/index.html.twig', [
            'articles' => $allPosts->getData(),'tag' => $tag, 'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/fr/tag/{tag}/{page}', name: 'blog_index_tag_fr2')]
    public function tagfr2(BlogPostApiClient $apiClient,string $tag,int $page): Response
    {
        $allPosts=$apiClient->getOnlineBlogPostsByTagFr($tag,$page,5);

        return $this->render('index/indexFR.html.twig', [
            'articles' => $allPosts->getData(),'tag' => $tag, 'pagination' => $allPosts->getPagination(),
        ]);
    }

    #[Route('/en/tag/{tag}/{page}', name: 'blog_index_tag2')]
    public function tag2(BlogPostApiClient $apiClient,string $tag,int $page): Response
    {


        $allPosts=$apiClient->getOnlineBlogPostsByTag($tag,$page,5);

        return $this->render('index/index.html.twig', [
            'articles' => $allPosts->getData(),'tag' => $tag, 'pagination' => $allPosts->getPagination(),
        ]);
    }
}
