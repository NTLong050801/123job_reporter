<?php


class AlgorithmString
{
    public static function calPercentMatchTwoString($string1, $string2)
    {
        similar_text($string1, $string2, $perc);
        return (int)$perc ?? 0;
    }
}
