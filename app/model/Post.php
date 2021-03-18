<?php

namespace App\Model;

class Post
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $created_at;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var string $title;
     * @return void
     */
    public function setTitle(string $title): void
    {
        $title = trim($title);
        $title = htmlspecialchars($title);
        $this->title = $title;
    }

    /**
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @var string $image;
     * @return void
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @var string $content;
     * @return void
     */
    public function setContent(string $content): void
    {
        $content = trim($content);
        $content = htmlspecialchars($content);
        $this->title = $content;
    }

    /**
     * @var string $date;
     * @return void
     */
    public function setCreatedAt(string $date): void
    {
        $this->created_at = $date;
    }

    /**
     * @var string $enabled;
     * @return void
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }
}
