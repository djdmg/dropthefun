<?php

namespace App\Service;

use App\Model\BlogPost;
use App\Model\BlogPostResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class BlogPostApiClient
{
    private HttpClientInterface $client;
    private string $apiBaseUrl;
    private string $apiKey;

    public function __construct(HttpClientInterface $client,private SerializerInterface $serializer)
    {
        $this->client = $client;

        $this->apiBaseUrl = 'https://worklessdjmore.com/api'; // Remplacez par l'URL de votre API distante
        $this->apiKey = 'VdqT43xqoKhcCk1GMdvJhQuBFsgJ85m5'; // Remplacez par la clé API de votre API
    }

    /**
     * Récupère les articles de blog en ligne
     *
     * @return array|null
     */
    public function getOnlineBlogPosts(int $page = 1, int $limit = 10) :BlogPostResponse
    {
        // Construire l'URL complète pour accéder à l'endpoint
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






        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {
            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)

            return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPostResponse(null,null);
    }

    /**
     * Récupère les articles anglais correcpondant à un certain tag
     *
     * @return array|null
     */
    public function getOnlineBlogPostsByTag($tag, $page = 1, int $limit = 10) :BlogPostResponse
    {
        // Construire l'URL complète pour accéder à l'endpoint
        $url = $this->apiBaseUrl . '/tag/'.urlencode($tag);



        // Effectuer la requête GET avec la clé API dans les headers
        $response = $this->client->request('GET', $url, [
            'query' => [
                'page' => $page,
                'limit' => $limit,
            ],
            'headers' => [
                'x-api-key' => $this->apiKey,
            ],
        ]);



        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {
            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)

            return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPostResponse(null,null);
    }

    public function getOnlineBlogPostsByTagFr($tag,int $page = 1, int $limit = 10) :BlogPostResponse
    {
        // Construire l'URL complète pour accéder à l'endpoint
        $url = $this->apiBaseUrl . '/tag/fr/'.urlencode($tag);



        // Effectuer la requête GET avec la clé API dans les headers
        $response = $this->client->request('GET', $url, [
            'query' => [
                'page' => $page,
                'limit' => $limit,
            ],
            'headers' => [
                'x-api-key' => $this->apiKey,
            ],
        ]);



        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {
            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)

            return $this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPostResponse(null,null);
    }

    public function getPostFR(string $WebTitleFR) :BlogPost
    {
        // Construire l'URL complète pour accéder à l'endpoint
        $url = $this->apiBaseUrl . '/edm-news/fr/'.$WebTitleFR;

        // Effectuer la requête GET avec la clé API dans les headers
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'x-api-key' => $this->apiKey
            ]
        ]);



        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {
            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)

            $article=$this->serializer->deserialize($response->getContent(), BlogPost::class, 'json');
            return $article;
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPost();
    }

    public function getPost(string $WebTitleEN) :BlogPost
    {
        // Construire l'URL complète pour accéder à l'endpoint
        $url = $this->apiBaseUrl . '/edm-news/'.$WebTitleEN;

        // Effectuer la requête GET avec la clé API dans les headers
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'x-api-key' => $this->apiKey
            ]
        ]);



        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {

            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)
            $article=$this->serializer->deserialize($response->getContent(), BlogPost::class, 'json');
            return $article;
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPost();
    }

    public function getPostByCategory(string $category,int $page = 1, int $limit = 10) :BlogPostResponse
    {
        // Construire l'URL complète pour accéder à l'endpoint
        $url = $this->apiBaseUrl . '/category/'.urlencode($category);

        // Effectuer la requête GET avec la clé API dans les headers
        $response = $this->client->request('GET', $url, [
            'query' => [
                'page' => $page,
                'limit' => $limit,
            ],
            'headers' => [
                'x-api-key' => $this->apiKey,
            ],
        ]);




        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {

            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)
            $article=$this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            return $article;
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPostResponse(null,null);
    }

    public function getPostByCategoryFr(string $category,int $page = 1, int $limit = 10) :BlogPostResponse
    {
        // Construire l'URL complète pour accéder à l'endpoint
        $url = $this->apiBaseUrl . '/fr/category/'.urlencode($category);

        // Effectuer la requête GET avec la clé API dans les headers
        $response = $this->client->request('GET', $url, [
            'query' => [
                'page' => $page,
                'limit' => $limit,
            ],
            'headers' => [
                'x-api-key' => $this->apiKey,
            ],
        ]);



        // Vérifier le statut HTTP de la réponse
        if ($response->getStatusCode() === 200) {

            // Récupérer et retourner le contenu de la réponse (décodé en tableau associatif)
            $article=$this->serializer->deserialize($response->getContent(), BlogPostResponse::class, 'json');
            return $article;
        }

        // Gérer les erreurs (par exemple, renvoyer null si une erreur survient)
        return new BlogPostResponse(null,null);
    }
}
