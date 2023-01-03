<?php

namespace App\Http\Services;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;

trait MNSGameSEO
{
    use SEOTools;

    /**
     * Setup default SEO on site
     *
     * @param string $title
     * @param string $description
     * @param string $url
     */
    private function setDefaultSEO(string $title, string $description, string $url): void
    {
        $this->seo()->setDescription("MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.");
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl($url);
        $this->seo()->opengraph()->addImage(asset("/img/mnsgame.png"));
        $this->seo()->opengraph()->setType("website");
        SEOMeta::addKeyword(["сервера", "мониторинг серверов", "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"]);
    }

    /**
     * Set SEO for page
     *
     * @param bool $isDefault
     * @param bool $isNotIndexing
     * @param array|null $options
     */
    protected function setPageSEO(bool $isDefault, $isNotIndexing = false, array $options = null): void
    {
        if ($isDefault) {
            $this->setDefaultSEO($options["title"], $options["description"], $options["url"]);
            return;
        }

        if ($isNotIndexing) {
            SEOMeta::addMeta("robots", "none");
            return;
        }

        $this->setSEOWithOptions($options);
    }

    /**
     * Set SEO on site with options
     *
     * @param array $options
     */
    private function setSEOWithOptions(array $options): void
    {
        if(isset($options["description"]))
            $this->seo()->setDescription($options["description"]);

        if(isset($options["opengraph"]["title"]))
            $this->seo()->opengraph()->setTitle($options["opengraph"]["title"]);

        if(isset($options["opengraph"]["description"]))
            $this->seo()->opengraph()->setDescription($options["opengraph"]["description"]);

        if(isset($options["opengraph"]["url"]))
            $this->seo()->opengraph()->setUrl($options["opengraph"]["url"]);

        if(isset($options["opengraph"]["image"]))
            $this->seo()->opengraph()->addImage($options["opengraph"]["image"]);

        if(isset($options["opengraph"]["type"]))
            $this->seo()->opengraph()->setType($options["opengraph"]["type"]);

        if(isset($options["keywords"]))
            SEOMeta::addKeyword($options["keywords"]);
    }
}
