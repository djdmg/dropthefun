<?php

// src/EventSubscriber/SitemapSubscriber.php

namespace App\EventListener;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use App\Service\BlogPostApiClient;
use Symfony\Component\Routing\RequestContext;
use Symfony\Contracts\Cache\CacheInterface;

class SitemapListener implements EventSubscriberInterface
{
    private UrlGeneratorInterface $router;
    private BlogPostApiClient $apiClient;
    private CacheInterface $cache;
    private RequestContext $context;

    public function __construct(UrlGeneratorInterface $router, BlogPostApiClient $apiClient, CacheInterface $cache)
    {
        $this->router = $router;
        $this->apiClient = $apiClient;
        $this->cache = $cache;
        $context= new RequestContext();
        $context->setHost("dropthefun.com");
        $context->setScheme("https");
        $this->router->setContext($context);
    }

    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::class => 'onSitemapPopulate',
        ];
    }

    public function onSitemapPopulate(SitemapPopulateEvent $event)
    {
        $section = $event->getSection();

        if (is_null($section)) {
            // Generate sitemaps for all languages
            $this->addUrlsForLocale($event, 'en');
            $this->addUrlsForLocale($event, 'fr');
        } elseif (in_array($section, ['en', 'fr'])) {
            $this->addUrlsForLocale($event, $section);
        }
    }

    private function addUrlsForLocale(SitemapPopulateEvent $event, string $locale)
    {
        $urlContainer = $event->getUrlContainer();

        // Add static URLs
        $routeName = $locale === 'fr' ? 'blog_index_fr' : 'blog_index';
        $url = $this->router->generate($routeName, [], UrlGeneratorInterface::ABSOLUTE_URL);
        $urlContainer->addUrl(
            new UrlConcrete($url, new \DateTime(), UrlConcrete::CHANGEFREQ_DAILY, 1.0),
            $locale
        );

        // Add dynamic URLs (e.g., blog posts)
        // Adjust this part according to your data fetching methods
        $page = 1;
        do {
            $blogPostsResponse = $this->apiClient->getOnlineBlogPosts($this->cache, $page, 100);
            $posts = $blogPostsResponse->getData();

            if (!$posts) {
                break;
            }

            foreach ($posts as $post) {
                $webTitle = $locale === 'fr' ? $post->getWebTitleFR() : $post->getWebTitleEN();
                $routeName = $locale === 'fr' ? 'blog_article_fr' : 'blog_article';
                $url = $this->router->generate($routeName, [$locale === 'fr' ? 'WebTitleFR' : 'WebTitleEN' => $webTitle], UrlGeneratorInterface::ABSOLUTE_URL);

                $urlContainer->addUrl(
                    new UrlConcrete($url, $post->getCreatedAt() ?? new \DateTime(), UrlConcrete::CHANGEFREQ_WEEKLY, 0.8),
                    $locale
                );
            }

            $page++;
        } while (count($posts) === 100);
    }
}

