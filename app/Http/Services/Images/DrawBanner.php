<?php


namespace App\Http\Services\Images;


class DrawBanner
{
    /**
     *
     * Для сайта
     *
     * @param $type
     * @param $rating
     * @return string
     */
    static function getImage($type, $rating): string
    {
        $drawer = new Drawer($type, $rating);

        return $drawer->getBase64EncodeView();
    }

    /**
     *
     * Для Api
     *
     * @param $type
     * @param $rating
     */
    static function getImageByApi($type, $rating)
    {
        $drawer = new Drawer($type, $rating);

        $drawer->getHeaderView();
    }
}
