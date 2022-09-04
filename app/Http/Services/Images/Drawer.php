<?php


namespace App\Http\Services\Images;

/**
 * Class Drawer
 * @package App\Http\Services\Images
 */
class Drawer
{
    /**
     *
     * Тип изображения
     *
     * @var int
     */
    private int $type;

    /**
     *
     * Рейтинг для отрисовки
     *
     * @var int
     */
    private int $rating;

    public function __construct($type, $rating)
    {
        $this->type = $this->getType($type);
        $this->rating = (int)$rating;
    }

    /**
     *
     * Проверка типа
     *
     * @param $type
     * @return int
     */
    private function getType($type): int
    {
        switch ($type){
            case 2:
                return 2;
            case 3:
                return 3;
            case 4:
                return 4;
            default:
                return 1;
        }
    }


    /**
     *
     * Получить ссылку на изображение
     *
     * @return string|null
     */
    private function getImageLink(): ?string
    {
        switch ($this->type){
            case 1:
                return asset("img/banner-1.png");
            case 2:
                return asset("img/banner-2.png");
            case 3:
                return asset("img/banner-3.png");
            case 4:
                return asset("img/banner-4.png");
            default:
                return null;
        }
    }

    /**
     *
     * Получить настройки
     *
     * @return array|null
     */
    private function getSettings(): ?array
    {
        switch ($this->type){
            case 1:
            case 2:
            case 3:
                return [
                    "text" => "Наш рейтинг: {$this->rating}",
                    "font" => public_path("fonts/Nunito-ExtraBold.ttf"),
                    "font_size" => 5.6,
                    "font_color" => [
                        "red" => 255,
                        "green" => 255,
                        "blue" => 255
                    ],
                    "position" => [
                        "x" => 11,
                        "y" => 25,
                        "angle" => 0,
                    ],
                ];
            case 4:
                return [
                    "text" => "Наш рейтинг: {$this->rating}",
                    "font" => public_path("fonts/Nunito-ExtraBold.ttf"),
                    "font_size" => 5.6,
                    "font_color" => [
                        "red" => 22,
                        "green" => 39,
                        "blue" => 49
                    ],
                    "position" => [
                        "x" => 11,
                        "y" => 25,
                        "angle" => 0,
                    ],
                ];
            default:
                return null;
        }
    }

    /**
     *
     * Отрисовка изображения
     *
     */
    private function drawImage()
    {
        $image = imagecreatefrompng($this->getImageLink());
        $settings = $this->getSettings();

        imagettftext(
            $image,
            $settings["font_size"],
            $settings["position"]["angle"],
            $settings["position"]["x"],
            $settings["position"]["y"],
            imagecolorallocate($image, $settings["font_color"]["red"], $settings["font_color"]["green"], $settings["font_color"]["blue"]),
            $settings["font"],
            $settings["text"]
        );

        return $image;
    }

    /**
     *
     * Для сайта
     *
     * @return string
     */
    public function getBase64EncodeView(): string
    {
        $image = $this->drawImage();
        ob_start();
        imagewebp($image, null, 100);
        $rawImageBytes = ob_get_clean();
        imagedestroy($image);
        return "data:image/jpeg;base64,".base64_encode($rawImageBytes);
    }

    /**
     *
     * Нужна для отображения по Api
     *
     */
    public function getHeaderView(){
        $image = $this->drawImage();
        header("Content-type: image/webp");
        imagewebp($image);
        imagedestroy($image);
    }
}
