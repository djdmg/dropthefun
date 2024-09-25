<?php

namespace App\Service;

use App\Model\BlogPost;
use App\Model\BlogPostResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class BlogPostApiClient
{
    private HttpClientInterface $client;
    private string $apiBaseUrl;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, private SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->apiBaseUrl = 'https://worklessdjmore.com/api'; // Replace with your API URL
        $this->apiKey = 'VdqT43xqoKhcCk1GMdvJhQuBFsgJ85m5'; // Replace with your API key
    }

    public function getOnlineBlogPosts(CacheInterface $cache, int $page = 1, int $limit = 10): BlogPostResponse
    {
        $cacheKey = sprintf('blog_posts_page_%d_limit_%d', $page, $limit);
        return $cache->get($cacheKey, function (ItemInterface $item) use ($page, $limit) {
            $item->expiresAfter(120);
            $url = $this->apiBaseUrl . '/edm-news';
            $response = $this->client->request('GET', $url, [
                'query' => [
                    'page' => $page,
                    'limit' => $limit,
                ],
                'headers' => [
                    'x-api-key' => $this->apiKey,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            }

            return new BlogPostResponse(null, null);
        });
    }

    public function getOnlineBlogPostsByTag(string $tag, CacheInterface $cache, int $page = 1, int $limit = 10): BlogPostResponse
    {
        $cacheKey = sprintf('blog_posts_tag_%s_page_%d_limit_%d', urlencode($tag), $page, $limit);
        return $cache->get($cacheKey, function (ItemInterface $item) use ($tag, $page, $limit) {
            $item->expiresAfter(1800);
            $url = $this->apiBaseUrl . '/tag/' . urlencode($tag);
            $response = $this->client->request('GET', $url, [
                'query' => [
                    'page' => $page,
                    'limit' => $limit,
                ],
                'headers' => [
                    'x-api-key' => $this->apiKey,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            }

            return new BlogPostResponse(null, null);
        });
    }

    public function getOnlineBlogPostsByTagFr(string $tag, CacheInterface $cache, int $page = 1, int $limit = 10): BlogPostResponse
    {
        $cacheKey = sprintf('blog_posts_fr_tag_%s_page_%d_limit_%d', urlencode($tag), $page, $limit);
        return $cache->get($cacheKey, function (ItemInterface $item) use ($tag, $page, $limit) {
            $item->expiresAfter(300);
            $url = $this->apiBaseUrl . '/tag/fr/' . urlencode($tag);
            $response = $this->client->request('GET', $url, [
                'query' => [
                    'page' => $page,
                    'limit' => $limit,
                ],
                'headers' => [
                    'x-api-key' => $this->apiKey,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            }

            return new BlogPostResponse(null, null);
        });
    }

    public function getPost(string $WebTitleEN, CacheInterface $cache): BlogPost
    {
        $cacheKey = 'blog_post_' . $WebTitleEN;
        return $cache->get($cacheKey, function (ItemInterface $item) use ($WebTitleEN) {
            $item->expiresAfter(3600);
            $url = $this->apiBaseUrl . '/edm-news/' . $WebTitleEN;
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'x-api-key' => $this->apiKey
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPost::class, 'json');
            }

            return new BlogPost();
        });
    }

    public function getPostFR(string $WebTitleFR, CacheInterface $cache): BlogPost
    {
        $cacheKey = 'blog_post_fr_' . $WebTitleFR;
        return $cache->get($cacheKey, function (ItemInterface $item) use ($WebTitleFR) {
            $item->expiresAfter(3600);
            $url = $this->apiBaseUrl . '/edm-news/fr/' . $WebTitleFR;
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'x-api-key' => $this->apiKey
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPost::class, 'json');
            }

            return new BlogPost();
        });
    }

    public function getPostByCategory(string $category, CacheInterface $cache, int $page = 1, int $limit = 10): BlogPostResponse
    {
        $cacheKey = sprintf('blog_posts_category_%s_page_%d_limit_%d', urlencode($category), $page, $limit);
        return $cache->get($cacheKey, function (ItemInterface $item) use ($category, $page, $limit) {
            $item->expiresAfter(300);
            $url = $this->apiBaseUrl . '/category/' . urlencode($category);
            $response = $this->client->request('GET', $url, [
                'query' => [
                    'page' => $page,
                    'limit' => $limit,
                ],
                'headers' => [
                    'x-api-key' => $this->apiKey,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            }

            return new BlogPostResponse(null, null);
        });
    }

    public function getPostByCategoryFr(string $category, CacheInterface $cache, int $page = 1, int $limit = 10): BlogPostResponse
    {
        $cacheKey = sprintf('blog_posts_fr_category_%s_page_%d_limit_%d', urlencode($category), $page, $limit);
        return $cache->get($cacheKey, function (ItemInterface $item) use ($category, $page, $limit) {
            $item->expiresAfter(300);
            $url = $this->apiBaseUrl . '/fr/category/' . urlencode($category);
            $response = $this->client->request('GET', $url, [
                'query' => [
                    'page' => $page,
                    'limit' => $limit,
                ],
                'headers' => [
                    'x-api-key' => $this->apiKey,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            }

            return new BlogPostResponse(null, null);
        });
    }
}
