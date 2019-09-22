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

use App\Entity\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Article
 *
 * @ORM\Table(name="amo_article")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article extends AbstractEntity
{
    use NameTrait;

    const LIST_STATE = [
        'for_sell',
        'sold',
    ];
    const LIST_GAME_GENDER = [
        'boy' => 'Garçon',
        'girl' => 'Fille',
        'mixed' => 'Mixte',
    ];

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="amo_owner_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $state;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $gender;

    /**
     * @var Brand|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand")
     * @ORM\JoinColumn(name="amo_brand_id", referencedColumnName="id")
     */
    protected $brand;

    /**
     * @var ArticleImage[]|Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleImage", mappedBy="article")
     */
    protected $images;

    /**
     * @var Age
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Age")
     * @ORM\JoinColumn(name="amo_age_id", referencedColumnName="id")
     */
    protected $age;

    /**
     * @var CategoryArticle
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryArticle")
     * @ORM\JoinColumn(name="amo_category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * Article constructor.
     *
     * @param string          $name
     * @param User            $owner
     * @param Age             $age
     * @param CategoryArticle $category
     * @param float           $price
     * @param string          $gender
     * @param string|null     $description
     * @param Brand|null      $brand
     * @param array|null      $images
     */
    public function __construct(
        string $name,
        User $owner,
        Age $age,
        CategoryArticle $category,
        float $price,
        string $gender,
        ?string $description,
        ?Brand $brand,
        ?array $images
    ) {
        $this->name = $name;
        $this->owner = $owner;
        $this->age = $age;
        $this->category = $category;
        $this->state = 'for_sell';
        $this->description = $description;
        $this->price = $price;
        $this->gender = $gender;
        $this->brand = $brand;
        $this->images = new ArrayCollection(is_array($images) ? $images : []);
        parent::__construct();
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    /**
     * @return ArticleImage[]|Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return Age
     */
    public function getAge(): Age
    {
        return $this->age;
    }

    /**
     * @return CategoryArticle
     */
    public function getCategory(): CategoryArticle
    {
        return $this->category;
    }
}
