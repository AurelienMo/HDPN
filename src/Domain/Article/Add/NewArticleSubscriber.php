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

use App\Domain\Common\Helpers\FileUploader;
use App\Domain\Common\Helpers\ImageConverter;
use App\Entity\Article;
use App\Entity\ArticleImage;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class NewArticleSubscriber
 */
class NewArticleSubscriber implements EventSubscriberInterface
{
    /** @var FileUploader */
    protected $fileUploader;

    /** @var ImageConverter */
    protected $imageConverter;

    /**
     * NewArticleSubscriber constructor.
     *
     * @param FileUploader   $fileUploader
     * @param ImageConverter $imageConverter
     */
    public function __construct(
        FileUploader $fileUploader,
        ImageConverter $imageConverter
    ) {
        $this->fileUploader = $fileUploader;
        $this->imageConverter = $imageConverter;
    }

    public static function getSubscribedEvents()
    {
        return [
            NewArticleEvent::NEW_ARTICLE => 'onAddArticle',
        ];
    }

    public function onAddArticle(NewArticleEvent $event)
    {
        $images = $this->buildImages($event->getInput()->getImages(), $event->getInput()->getUser());
        //TODO Load age / category & brand.
        $article = Article::create(
            $event->getInput(),
            $age,
            $category,
            $brand,
            $images
        );
    }

    private function buildImages(User $user, array $images)
    {
        $imgs = [];
        foreach ($images as $image) {
            $imgConvert = ImageConverter::convertBase64ToImg($image->getImage());
            $filePath = $this->fileUploader->uploadImage($user, $imgConvert, FileUploader::ARTICLE);
            $imgs[] = ArticleImage::create($filePath);
        }

        return $imgs;
    }
}
