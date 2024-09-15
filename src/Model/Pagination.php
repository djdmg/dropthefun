<?php

namespace App\Model;

class Pagination
{
    private $current_page;
    private $per_page;
    private $total_items;
    private $total_pages;
    private $has_previous_page;
    private $has_next_page;
    private $previous_page;
    private $next_page;

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->current_page;
    }

    public function current_page()
    {
        return $this->current_page;
    }

    /**
     * @param mixed $current_page
     */
    public function setCurrentPage($current_page): void
    {
        $this->current_page = $current_page;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->per_page;
    }

    /**
     * @param mixed $per_page
     */
    public function setPerPage($per_page): void
    {
        $this->per_page = $per_page;
    }

    /**
     * @return mixed
     */
    public function getTotalItems()
    {
        return $this->total_items;
    }

    /**
     * @param mixed $total_items
     */
    public function setTotalItems($total_items): void
    {
        $this->total_items = $total_items;
    }

    /**
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->total_pages;
    }

    public function total_pages()
    {
        return $this->total_pages;
    }

    /**
     * @param mixed $total_pages
     */
    public function setTotalPages($total_pages): void
    {
        $this->total_pages = $total_pages;
    }

    /**
     * @return mixed
     */
    public function getHasPreviousPage()
    {
        return $this->has_previous_page;
    }
    public function has_previous_page()
    {
        return $this->has_previous_page;
    }


    /**
     * @param mixed $has_previous_page
     */
    public function setHasPreviousPage($has_previous_page): void
    {
        $this->has_previous_page = $has_previous_page;
    }

    /**
     * @return mixed
     */
    public function getHasNextPage()
    {
        return $this->has_next_page;
    }

    public function has_next_page()
    {
        return $this->has_next_page;
    }

    /**
     * @param mixed $has_next_page
     */
    public function setHasNextPage($has_next_page): void
    {
        $this->has_next_page = $has_next_page;
    }

    /**
     * @return mixed
     */
    public function getPreviousPage()
    {
        return $this->previous_page;
    }

    public function getprevious_page()
    {
        return $this->previous_page;
    }

    /**
     * @param mixed $previous_page
     */
    public function setPreviousPage($previous_page): void
    {
        $this->previous_page = $previous_page;
    }

    /**
     * @return mixed
     */
    public function getNextPage()
    {
        return $this->next_page;
    }

    public function getnext_page()
    {
        return $this->next_page;
    }

    /**
     * @param mixed $next_page
     */
    public function setNextPage($next_page): void
    {
        $this->next_page = $next_page;
    }


}