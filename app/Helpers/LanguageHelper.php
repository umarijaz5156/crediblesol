<?php


use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Enums\LanguageEnum;
use Illuminate\Support\Facades\Cache;


function setDefaultLang($locale)
{
    // dd($locale );
    $allLangs = getAllLangs();
    // Check if $locale matches any key in the $allLangs array
    if (array_key_exists($locale, $allLangs)) {
        // dd($allLangs);
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return true; // Return true if the locale is set successfully
    }

    return false; // Return false if $locale is not found in the array
}

function ___($text, $targetLanguage = null)
{
    if ($targetLanguage === null) {
        $targetLanguage = getLang();
    }

    // Generate a cache key based on the text and target language
    $cacheKey = "translation_{$targetLanguage}_{$text}";
    // Check if the translation is already cached
    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }

    // If not cached, fetch the translation
    $translator = new GoogleTranslate();
    $translation = $translator->setSource('en')->setTarget($targetLanguage)->translate($text);

    Cache::put($cacheKey, $translation, 60); 

    return $translation;
}

function getLang()
{
    return session()->get('locale') ??  app()->getLocale() ?? config('app.locale') ?? 'en';
}

function getAllLangs()
{
    return LanguageEnum::getAllLanguageCodes();
}