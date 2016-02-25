<?php

namespace Hazzard\Validation;

use ArrayAccess;

class Arr
{
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  \ArrayAccess|array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public static function get($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }
        if (isset($array[$key])) {
            return $array[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if ((! is_array($array) || ! array_key_exists($segment, $array)) &&
                (! $array instanceof ArrayAccess || ! $array->offsetExists($segment))) {
                return value($default);
            }
            $array = $array[$segment];
        }
        return $array;
    }
}