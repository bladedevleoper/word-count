<?php

namespace App\Traits;

trait BuildString
{
    public $conjunction = '&';

    public function forMultipleValues(array $array):string
    {

        $keys = array_keys($array);
        $frequentLength = $array[$keys[0]];
        $last = array_pop($keys);


        return 'The most frequently occurring word length is ' .$frequentLength.', for word lengths of ' . implode(',', $keys) . ' ' . $this->conjunction . ' ' . $last;

    }


    public function forOneValue(array $array): string
    {
        $keys = array_keys($array);
        $frequentLength = $array[$keys[0]];

        return 'The most frequently occurring word length is ' .$frequentLength.', for word lengths of ' .$keys[0];
    }
}