<?php

namespace App\Model;

class BlogPostSEODetail
{

    private array $keywordsEN = [];
    /** @var string[] */
    private array $keywordsFR = [];
    private ?string $metaTitleEN = null;
    private ?string $metaTitleFR = null;
    private ?string $metaDescriptionFR = null;
    private ?string $metaDescriptionEN = null;
    private ?string $altImageEN = null;
    private ?string $altImageFR = null;

    // Getters et Setters


    public function getKeywordsEN(): array
    {
        return $this->keywordsEN;
    }

    public function setKeywordsEN(array $keywordsEN): BlogPostSEODetail
    {
        $this->keywordsEN = $keywordsEN;
        return $this;
    }

    public function getKeywordsFR(): array
    {
        return $this->keywordsFR;
    }

    public function setKeywordsFR(array $keywordsFR): BlogPostSEODetail
    {
        $this->keywordsFR = $keywordsFR;
        return $this;
    }

    public function getMetaTitleEN(): ?string
    {
        return $this->metaTitleEN;
    }

    public function setMetaTitleEN(?string $metaTitleEN): BlogPostSEODetail
    {
        $this->metaTitleEN = $metaTitleEN;
        return $this;
    }

    public function getMetaTitleFR(): ?string
    {
        return $this->metaTitleFR;
    }

    public function setMetaTitleFR(?string $metaTitleFR): BlogPostSEODetail
    {
        $this->metaTitleFR = $metaTitleFR;
        return $this;
    }

    public function getMetaDescriptionFR(): ?string
    {
        return $this->metaDescriptionFR;
    }

    public function setMetaDescriptionFR(?string $metaDescriptionFR): BlogPostSEODetail
    {
        $this->metaDescriptionFR = $metaDescriptionFR;
        return $this;
    }

    public function getMetaDescriptionEN(): ?string
    {
        return $this->metaDescriptionEN;
    }

    public function setMetaDescriptionEN(?string $metaDescriptionEN): BlogPostSEODetail
    {
        $this->metaDescriptionEN = $metaDescriptionEN;
        return $this;
    }

    public function getAltImageEN(): ?string
    {
        return $this->altImageEN;
    }

    public function setAltImageEN(?string $altImageEN): BlogPostSEODetail
    {
        $this->altImageEN = $altImageEN;
        return $this;
    }

    public function getAltImageFR(): ?string
    {
        return $this->altImageFR;
    }

    public function setAltImageFR(?string $altImageFR): BlogPostSEODetail
    {
        $this->altImageFR = $altImageFR;
        return $this;
    }
}