<?php


use App\Models\Settings;

function tenancyFn($var)
{

}

function viteAsset($asset)
{

    return \Illuminate\Support\Facades\Vite::asset($asset);
}

function getTenantId($c = "")
{
    return "wepremios-com-br";
}

if (!function_exists('getInstagram')) {
    function getInstagram()
    {
        return Settings::get('instagram');
    }
}

if (!function_exists('getTikTok')) {
    function getTikTok()
    {
        return Settings::get('TikTok');
    }
}

if (!function_exists('getYouTube')) {
    function getYouTube()
    {
        return Settings::get('YouTube');
    }
}

if (!function_exists('getTelegram')) {
    function getTelegram()
    {
        return Settings::get('Telegram');
    }
}

if (!function_exists('getWhatsappSuporteSite')) {
    function getWhatsappSuporteSite()
    {
        return Settings::get('WhatsappSuporteSite');
    }
}

if (!function_exists('getWhatsappGrupo')) {
    function getWhatsappGrupo()
    {
        return Settings::get('WhatsappGrupo');
    }
}

if (!function_exists('getTwitter')) {
    function getTwitter()
    {
        return Settings::get('twitter');
    }
}

if (!function_exists('getFacebook')) {
    function getFacebook()
    {
        return Settings::get('facebook');
    }
}

if (!function_exists('getLinkedin')) {
    function getLinkedin()
    {
        return Settings::get('linkedin') ?? null;
    }
}

if (!function_exists('getDiscord')) {
    function getDiscord()
    {
        return Settings::get('discord');
    }
}

function formatNumberWithLeadingZeros($number, $maxNumber)
{
    // Calculate the number of digits in the maximum number
    $totalDigits = strlen((string)$maxNumber);

    // Return the formatted number with leading zeros
    return sprintf('%0' . $totalDigits . 'd', $number);
}

if (!function_exists('getCommissioningPercentage')) {
    function getCommissioningPercentage()
    {
        return Settings::get('commissioning_percentage');
    }
}
if (!function_exists('getCommissioning')) {
    function getCommissioning()
    {
        return Settings::get('commissioning');
    }
}
if (!function_exists('commissioning_rules')) {
    function getCommissioningRules()
    {
        return Settings::get('commissioning_rules');
    }
}
if (!function_exists('getLogo')) {
    function getLogo()
    {
        return Settings::get('logo');
    }
}

if (!function_exists('getSiteName')) {
    function getSiteName()
    {
        return Settings::get('site_name');
    }
}

if (!function_exists('getAcceptedUseTerms')) {
    function getAcceptedUseTerms()
    {
        return Settings::get('terms_of_use_accepted');
    }
}
