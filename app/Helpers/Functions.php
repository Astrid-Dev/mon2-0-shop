<?php
namespace App\Helpers;

class Functions
{
    public static function generateUniqueKey($prefix = '', $suffix = '', $min = 10000000, $max = 99999999)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $prefix.($min + $rnd).$suffix;
    }

    public static function getWhatsappLinkToContactProvider($providerWhatsappNumber, $productName, $productUrl)
    {
        $userIsAuthenticated = auth()->check();
        $username = $userIsAuthenticated ? auth()->user()->username : null;
        $nameAndApp = __('helpers.contact.'.($username ? '' : 'un').'known_user', [
            'username' => $username,
            'appName' => env('APP_NAME'),
        ]);
        $body = __('helpers.contact.about', [
            'productName' => $productName,
            'productUrl' => $productUrl,
        ]);
        $salutation = __('helpers.contact.hi');
        $text = urlencode($salutation.' '.$nameAndApp).'. '.$body;
        return "https://wa.me/$providerWhatsappNumber?text=$text";
    }

    public static function getNewWhatsappChatLink($phone, $message = null)
    {
        $text = $message ? urlencode($message) : '';
        return "https://wa.me/$phone?text=$text";
    }

}
