<?php

class Sort
{
    public function sorting(string $str)
    {
        $array = array_map(function ($item) {
            return is_numeric($item) ? (int)$item : 0;
        }, explode(' ', $str));

        $array = array_unique($array, SORT_NUMERIC);
        sort($array, SORT_NUMERIC);

        echo implode(' ', $array);
    }
}