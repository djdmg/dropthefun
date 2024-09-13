<?php

namespace App\Model;

class BlogPostCategorisation
{
    private ?int $id = null;


    private ?string $name_en = null;


    private ?string $name_fr = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(?string $name_en): void
    {
        $this->name_en = $name_en;
    }

    public function getNameFr(): ?string
    {
        return $this->name_fr;
    }

    public function setNameFr(?string $name_fr): void
    {
        $this->name_fr = $name_fr;
    }



}