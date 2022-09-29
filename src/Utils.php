<?php

namespace Paybox;

class Utils
{

    /**
     *
     * @param [type] $value
     * @param [type] $type
     * @param [type] $maxLength
     * @return void
     */
    static function formatTextValue(string $value, string $type, int $maxLength = null)
    {
        /*
        AN : Alphanumerical without special characters
        ANP : Alphanumerical with spaces and special characters
        ANS : Alphanumerical with special characters
        N : Numerical only
        A : Alphabetic only
        */

        switch ($type) {
            default:
            case 'AN':
                $value = self::remove_accents($value);
                break;
            case 'ANP':
                $value = self::remove_accents($value);
                $value = preg_replace('/[^-. a-zA-Z0-9]/', '', $value);
                break;
            case 'ANS':
                break;
            case 'N':
                $value = preg_replace('/[^0-9.]/', '', $value);
                break;
            case 'A':
                $value = self::remove_accents($value);
                $value = preg_replace('/[^A-Za-z]/', '', $value);
                break;
        }
        // Remove carriage return characters
        $value = trim(preg_replace("/\r|\n/", '', $value));

        // Cut the string when needed
        if (!empty($maxLength) && $maxLength > 0) {
            if (function_exists('mb_strlen')) {
                if (mb_strlen($value) > $maxLength) {
                    $value = mb_substr($value, 0, $maxLength);
                }
            } elseif (strlen($value) > $maxLength) {
                $value = substr($value, 0, $maxLength);
            }
        }

        return $value;
    }

    static public function remove_accents($string, $locale = null)
    {
        setlocale(LC_ALL, $locale ?? 'en_US.utf8');
        return iconv('utf-8', 'ascii//TRANSLIT', $string);
    }
}
