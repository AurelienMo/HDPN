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
        'for_sell' => 'A vendre',
        'sold' => 'Vendu',
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
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $ageMin;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $ageMax;

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
     * Article constructor.
     *
     * @param User                      $owner
     * @param string                    $state
     * @param string|null               $description
     * @param float                     $price
     * @param string                    $gender
     * @param int|null                  $ageMin
     * @param int|null                  $ageMax
     * @param Brand|null                $brand
     * @param array|null                $images
     */
    public function __construct(
        User $owner,
        string $state,
        ?string $description,
        float $price,
        string $gender,
        ?int $ageMin,
        ?int $ageMax,
        ?Brand $brand,
        ?array $images
    ) {
        $this->owner = $owner;
        $this->state = $state;
        $this->description = $description;
        $this->price = $price;
        $this->gender = $gender;
        $this->ageMin = $ageMin;
        $this->ageMax = $ageMax;
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
     * @return int|null
     */
    public function getAgeMin(): ?int
    {
        return $this->ageMin;
    }

    /**
     * @return int|null
     */
    public function getAgeMax(): ?int
    {
        return $this->ageMax;
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
}
