<?php

declare(strict_types=1);

/*
 * This file is part of HDPN-be
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ArticleImage
 *
 * @ORM\Table(name="amo_article_image")
 * @ORM\Entity()
 */
class ArticleImage extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $path;

    /**
     * @var Article|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="images")
     * @ORM\JoinColumn(name="amo_article_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    protected $article;

    public function __construct(
        string $path
    ) {
        $this->path = $path;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Article|null
     */
    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public static function create(string $filePath)
    {
        return new self($filePath);
    }
}
