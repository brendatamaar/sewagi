<?php

use Illuminate\Support\Facades\Session;

function randomBackground($dir) {
    $images = glob(public_path($dir)."/*.jpg");
    if (!empty($images)) {
        $background = $images[array_rand($images)];
        return "/{$dir}/".basename($background);
    }
    return null;
}

/**
 * Format given number to string formatted money based on user
 * chose currency format.
 *
 * @param  int|string  $num
 * @return string
 */
function moneyFormat($num, $includePrefix = false) {
    $currency = Session::get('currency', 'idr');
    $prefix = '';
    $result = '';

    if ($currency === 'idr') {
        if ($includePrefix) {
            $prefix = 'IDR ';
        }

        $result = number_format($num, 0, ',', '.');
    }

    if ($currency === 'usd') {
        if ($includePrefix) {
            $prefix = 'USD ';
        }

        $result = number_format($num, 0, '.', ',');
    }

    return $prefix.$result;
}

/**
 * Get localisation settings by read database and session
 *
 * @param  array  $locale
 * @param  int|string  $key
 * @param  int|string $defaultWord
 * @return string
 */

function getLocale($locale=[], $key='', $defaultWord = '')
{
    return isset($locale[$key][session('locale')]) ? $locale[$key][session('locale')] : ($defaultWord!='' ? $defaultWord : @$locale[$key]['en'] ) ;
}
