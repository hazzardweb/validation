<?php

namespace Hazzard\Validation;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Symfony\Component\Translation\TranslatorInterface;

class Translator implements TranslatorInterface
{
    /**
     * The language lines used by the translator.
     *
     * @var array
     */
    protected $lines;

    /**
     * Create a new translator instance.
     *
     * @param array $lines
     */
    public function __construct(array $lines = [])
    {
        if (count($lines)) {
            $this->setLines($lines);
        }
    }

    /**
     * Set the language lines used by the translator.
     *
     * @param  array $lines
     * @return void
     */
    public function setLines(array $lines)
    {
        $this->lines = ['validation' => $lines];
    }

    /**
     * Get the translation for a given key.
     *
     * @param  string $id
     * @param  array  $parameters
     * @param  string $domain
     * @param  string $locale
     * @return string
     */
    public function trans($id, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $line = Arr::get($this->lines, $id);

        if (is_null($line)) {
            return $id;
        }

        return $this->makeReplacements($line, $parameters);
    }

    /**
     * Make the place-holder replacements on a line.
     *
     * @param  string $line
     * @param  array  $replace
     * @return string
     */
    protected function makeReplacements($line, array $replace)
    {
        $replace = (new Collection($replace))->sortBy(function ($value, $key) {
            return mb_strlen($key) * -1;
        });

        foreach ($replace as $key => $value) {
            $line = str_replace(':'.$key, $value, $line);
        }

        return $line;
    }

    /**
     * @inheritDoc
     */
    public function transChoice($id, $number, array $parameters = [], $domain = 'messages', $locale = null)
    {

    }

    /**
     * @inheritDoc
     */
    public function setLocale($locale)
    {

    }

    /**
     * @inheritDoc
     */
    public function getLocale()
    {

    }
}
