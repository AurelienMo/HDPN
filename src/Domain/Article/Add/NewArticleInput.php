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

namespace App\Domain\Article\Add;

use App\Domain\Common\Validators\ValidEntityInput;
use App\Domain\Common\ValueObject\Input\AuthoredInput;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NewArticleInput
 */
class NewArticleInput extends AuthoredInput
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="Le nom de l'article est requis."
     * )
     */
    protected $name;

    /**
     * @var float|null
     *
     * @Assert\NotBlank(
     *     message="Le prix de l'article est requis."
     * )
     */
    protected $price;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="Le type de jouet est requis."
     * )
     */
    protected $gender;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="La tranche d'âge est requise."
     * )
     * @ValidEntityInput(
     *     message="Cette tranche d'âge n'existe pas.",
     *     class="App\Entity\Age"
     * )
     */
    protected $age;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="La catégorie est requise."
     * )
     * @ValidEntityInput(
     *     message="Cette catégorie n'existe pas.",
     *     class="App\Entity\CategoryArticle"
     * )
     */
    protected $category;

    /** @var string|null */
    protected $description;

    /** @var ImageInput[] */
    protected $images;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getAge(): ?string
    {
        return $this->age;
    }

    /**
     * @param string|null $age
     */
    public function setAge(?string $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return ImageInput[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param ImageInput[] $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }
}
