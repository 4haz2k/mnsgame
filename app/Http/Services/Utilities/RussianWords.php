<?php


namespace App\Http\Services\Utilities;


class RussianWords
{
    /**
     * Склонение существительных после числительных
     *
     * @param string $value Значение
     * @param array $words Массив вариантов
     * @param bool $show Включает значение $value в результирующею строку
     * @return string
     */
    public static function wordDeclension(string $value, array $words, $show = true): string {
        $num = $value % 100;

        if ($num > 19) {
            $num = $num % 10;
        }

        $out = ($show) ?  $value . ' ' : '';

        switch ($num) {
            case 1:  $out .= $words[0]; break;
            case 2:
            case 3:
            case 4:  $out .= $words[1]; break;
            default: $out .= $words[2]; break;
        }

        return $out;
    }
}
