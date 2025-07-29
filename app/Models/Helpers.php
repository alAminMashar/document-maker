<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use NumberFormatter;

class Helpers extends Model
{
    // works both in windows and unix
    public static function mb_basename($path) {

        if (preg_match('@^.*[\\\\/]([^\\\\/]+)$@s', $path, $matches)) {
            return $matches[1];
        } else if (preg_match('@^([^\\\\/]+)$@s', $path, $matches)) {
            return $matches[1];
        }

        return '';

    }

    public static function amountInWords($amount){

        $formater = new NumberFormatter("en", NumberFormatter::SPELLOUT);

        $amount_in_words = $formater->format($amount);

        //Append currency and only
        $currency = config('app.currency_full');

        //Format text presentable
        $amount_in_words = ucwords($amount_in_words." $currency only.");

        return $amount_in_words;

    }

    public static function obscureLastTwoCharacters($input) {
        $length = strlen($input);

        if ($length < 2) {
            // If the string has less than 2 characters, obscure all of them
            return str_repeat('*', $length);
        }

        // Show all characters except the last two, then append "**"
        return substr($input, 0, $length - 2) . '**';
    }

}
