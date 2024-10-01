<?php

namespace App\Controller;

use App\Service\BlogPostApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * Route principale qui redirige en fonction de la langue préférée de l'utilisateur.
     * Cette route sert principalement la version anglaise.
     */
    #[Route('/', name: 'blog_index')]
    public function index(Request $request, BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        // Vérifier si la langue est déjà stockée dans la session
        $session = $request->getSession();
        if ($session->has('preferred_language')) {
            $preferredLanguage = $session->get('preferred_language');
        } else {
            // Détection de la langue préférée de l'utilisateur
            $preferredLanguage = $request->getPreferredLanguage(['fr', 'en']);
            $session->set('preferred_language', $preferredLanguage);
        }

        if ($preferredLanguage === 'fr') {
            // Redirection vers la version française
            return $this->redirectToRoute('blog_index_fr');
        }

        // Si la langue préférée n'est pas 'fr', servir la version anglaise
        $allPosts = $apiClient->getOnlineBlogPosts($cache, 1, 5);

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    /**
     * Route pour la version française du site.
     */
    #[Route('/fr/', name: 'blog_index_fr')]
    public function indexFr(Request $request, BlogPostApiClient $apiClient, CacheInterface $cache): Response
    {
        // Mettre à jour la langue préférée dans la session
        $session = $request->getSession();
        $session->set('preferred_language', 'fr');

        $allPosts = $apiClient->getOnlineBlogPosts($cache, 1, 5);

        return $this->render('index/indexFR.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    /**
     * Route pour les articles en français avec pagination.
     */
    #[Route('/fr/articles/{page}', name: 'blog_index_fr_articles', requirements: ['page' => '\d+'])]
    public function blogIndexFrArticles(BlogPostApiClient $apiClient, CacheInterface $cache, int $page, Request $request): Response
    {
        // Mettre à jour la langue préférée dans la session
        $session = $request->getSession();
        $session->set('preferred_language', 'fr');

        $allPosts = $apiClient->getOnlineBlogPosts($cache, $page, 5);

        return $this->render('index/indexFR.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }

    /**
     * Route pour les articles en anglais avec pagination.
     */
    #[Route('/articles/{page}', name: 'blog_index_en_articles', requirements: ['page' => '\d+'])]
    public function blogIndexEnArticles(BlogPostApiClient $apiClient, CacheInterface $cache, int $page, Request $request): Response
    {
        // Mettre à jour la langue préférée dans la session
        $session = $request->getSession();
        $session->set('preferred_language', 'en');

        $allPosts = $apiClient->getOnlineBlogPosts($cache, $page, 5);

        return $this->render('index/index.html.twig', [
            'articles'   => $allPosts->getData(),
            'pagination' => $allPosts->getPagination(),
        ]);
    }
}
