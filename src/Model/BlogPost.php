<?php

namespace App\Model;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Doctrine\Common\Collections\Collection;


class BlogPost
{

    private int $id;


    private string $title;


    private string $content;


    private ?string $image = null;


    private \DateTimeInterface $createdAt;


    private ?string $TitleFR = null;


    private ?string $TitleEN = null;


    private ?string $ContentFR = null;


    private ?string $ContentEN = null;


    private ?string $Image2 = null;


    private ?User $CreatedBy = null;


    private ?bool $WritedByIA = null;


    private ?bool $Handled = null;


    private ?bool $Online = null;


    private ?string $WebTitleEN = null;


    private ?string $WebTitleFR = null;


    private ?bool $isImageDownloaded = null;

    private ?string $previousPostId = null;

    private ?string $nextPostId = null;

    private ?string $previousPostTitle = null;

    private ?string $nextPostTitle = null;

    private ?BlogPostCategorisation $Categorisation = null;


    private array $Tags = [];



    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->setOnline(false);
        $this->setImage(null);
        $this->setImageDownloaded(false);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {

        return $this->addHttpsPrefix($this->image);
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTitleFR(): ?string
    {
        return $this->TitleFR;
    }

    public function setTitleFR(?string $TitleFR): static
    {
        $this->TitleFR = $TitleFR;
        $this->setWebTitleFR($this->remplacerEspacesParTirets($TitleFR));

        return $this;
    }

    public function getTitleEN(): ?string
    {
        return $this->TitleEN;

    }

    public function setTitleEN(?string $TitleEN): static
    {
        $this->TitleEN = $TitleEN;
        $this->setWebTitleEN($this->remplacerEspacesParTirets($TitleEN));
        return $this;
    }

    public function getContentFR(): ?string
    {
        return  str_replace($this->getTitleFR(), "", $this->ContentFR);
    }

    public function setContentFR(?string $ContentFR): static
    {
        $this->ContentFR = $ContentFR;

        return $this;
    }

    public function getContentEN(): ?string
    {

        return  str_replace($this->getTitleEN(), "", $this->ContentEN);
    }

    public function setContentEN(?string $ContentEN): static
    {
        $this->ContentEN = $ContentEN;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->Image2;
    }

    public function setImage2(?string $Image2): static
    {
        $this->Image2 = $Image2;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->CreatedBy;
    }

    public function setCreatedBy(?User $CreatedBy): static
    {
        $this->CreatedBy = $CreatedBy;

        return $this;
    }

    public function isWritedByIA(): ?bool
    {
        return $this->WritedByIA;
    }

    public function setWritedByIA(?bool $WritedByIA): static
    {
        $this->WritedByIA = $WritedByIA;

        return $this;
    }

    public function isHandled(): ?bool
    {
        return $this->Handled;
    }

    public function setHandled(bool $Handled): static
    {
        $this->Handled = $Handled;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->Online;
    }

    public function setOnline(bool $Online): static
    {
        $this->Online = $Online;

        return $this;
    }

    public function getWebTitleEN(): ?string
    {
        return $this->WebTitleEN;
    }

    public function setWebTitleEN(?string $WebTitleEN): static
    {
        $this->WebTitleEN = $WebTitleEN;

        return $this;
    }

    public function getWebTitleFR(): ?string
    {
        return $this->WebTitleFR;
    }

    public function setWebTitleFR(?string $WebTitleFR): static
    {
        $this->WebTitleFR = $WebTitleFR;

        return $this;
    }
    private function remplacerEspacesParTirets(string $texte): string
    {
        $slugger = new AsciiSlugger();
        return $slugger->slug($texte)->lower();
    }

    public function isImageDownloaded(): ?bool
    {
        return $this->isImageDownloaded;
    }

    public function setImageDownloaded(?bool $isImageDownloaded): static
    {
        $this->isImageDownloaded = $isImageDownloaded;

        return $this;
    }

    private function addHttpsPrefix(string $url): string
    {
        // Vérifier si l'URL ne commence pas par 'https://' ou 'http://'
        if (!preg_match('~^(http://|https://)~', $url)) {
            // Ajouter 'https://' au début de l'URL
            return 'https://worklessdjmore.com/' . $url;
        }

        // Si l'URL contient déjà 'https://' ou 'http://', la retourner telle quelle
        return $url;
    }

    public function getPreviousPostId(): ?string
    {
        return $this->previousPostId;
    }

    public function setPreviousPostId(?string $previousPostId): void
    {
        $this->previousPostId = $previousPostId;
    }

    public function getNextPostId(): ?string
    {
        return $this->nextPostId;
    }

    public function setNextPostId(?string $nextPostId): void
    {
        $this->nextPostId = $nextPostId;
    }





    public function getIsImageDownloaded(): ?bool
    {
        return $this->isImageDownloaded;
    }

    public function setIsImageDownloaded(?bool $isImageDownloaded): void
    {
        $this->isImageDownloaded = $isImageDownloaded;
    }

    public function getNextPostTitle(): ?string
    {
        return $this->nextPostTitle;
    }

    public function setNextPostTitle(?string $nextPostTitle): void
    {
        $this->nextPostTitle = $nextPostTitle;
    }

    public function getPreviousPostTitle(): ?string
    {
        return $this->previousPostTitle;
    }

    public function setPreviousPostTitle(?string $previousPostTitle): void
    {
        $this->previousPostTitle = $previousPostTitle;
    }

    public function getCategorisation(): ?BlogPostCategorisation
    {
        return $this->Categorisation;
    }

    public function setCategorisation(?BlogPostCategorisation $Categorisation): void
    {
        $this->Categorisation = $Categorisation;
    }

    public function getTags(): array
    {
        return $this->Tags;
    }

    public function setTags(array $Tags): void
    {
        $this->Tags = $Tags;
    }



}
