<?php

namespace Modules\Translation;

use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\FileLoader;
use Modules\Translation\Entities\Translation;

class TranslationLoader extends FileLoader
{
    /**
     * Get translation file paths.
     *
     * @return array
     */
    public function paths()
    {
        return array_merge([$this->path], $this->hints);
    }

    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {

        if (! config('app.cache')) {

            return $this->getTranslations($locale, $group, $namespace);
        }

        return Cache::tags('translations')
            ->rememberForever("translation_loader.{$locale}.{$group}.{$namespace}", function () use ($locale, $group, $namespace) {
                return $this->getTranslations($locale, $group, $namespace);
            });
    }

    /**
     * Get file and database translations.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     * @return array
     */
    private function getTranslations($locale, $group, $namespace)
    {
        return array_merge(
            $this->fileTranslations($locale, $group, $namespace),
            $this->databaseTranslations($locale, $group, $namespace)
        );
    }

    /**
     * Get file translations.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     * @return array
     */
    private function fileTranslations($locale, $group, $namespace)
    {
        return parent::load($locale, $group, $namespace);
    }

    /**
     * Get database translations.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     * @return array
     */
    private function databaseTranslations($locale, $group, $namespace)
    {
        return Translation::where('key', 'LIKE', "{$namespace}::{$group}.%")
                ->whereHas('translations', function ($query) use ($locale) {
                    $query->where('locale', $locale);
                })->get()->mapWithKeys(function ($translation) use ($namespace, $group) {
                    $key = str_replace("{$namespace}::{$group}.", '', $translation->key);

                    return [$key => $translation->value];
                })->all();
    }
}
