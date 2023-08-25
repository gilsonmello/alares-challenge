<?php

namespace App;

class Helper
{
    /**
     *
     * @param string $string
     * @return string
     */
    public static function unmask($string)
    {
        $formattedValue = preg_replace('/[a-zA-Z\$\s]/', '', $string);
        $formattedValue = preg_replace('/\./', '', $formattedValue);
        $formattedValue = preg_replace('/\,/', '.', $formattedValue);
        return $formattedValue;
    }

    /**
     *
     * @param string $string
     * @return string
     */
    public static function maskMoney($string)
    {
        return $string ? 'R$ ' . number_format((string) $string, 2, ',', '.') : '';
    }
}
