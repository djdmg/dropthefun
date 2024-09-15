<?php

namespace App\Model;

class BlogPostResponse
{
    /** @var BlogPost[] */
    public array $data;

    public Pagination $pagination;

    /**
     * Constructeur pour initialiser les propriétés.
     *
     * @param BlogPost[] $data
     * @param Pagination $pagination
     */
    public function __construct(array $data, Pagination $pagination)
    {
        $this->data = $data;
        $this->pagination = $pagination;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): void
    {
        $this->pagination = $pagination;
    }


}
