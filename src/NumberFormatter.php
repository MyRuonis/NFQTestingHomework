<?php
declare(strict_types=1);

namespace NumberFormatter;

class NumberFormatter
{
    public function formatNumber(float $value) : string
    {
        $tmpValue = abs($value);
        $answer = "";

        if($tmpValue >= 999950)
        {
            $number = $tmpValue/1000000;
            $number = round($number, 2);

            $answer = $number . "M";
        }

        else if ($tmpValue >= 99950)
        {
            $number = $tmpValue/1000;
            $number = round($number, 0);

            $answer = $number . "K";
        }

        else if ($tmpValue >= 1000)
        {
            $number1 = round($tmpValue, 0);

            $answer = intval($number1/1000) . " " . $number1%1000;
        }

        else
        {
            $number = round($tmpValue, 2);
            if(($number * 100) % 100 == 0) $answer = round($tmpValue, 0);
            else $answer = number_format($number,2,'.','');
        }

        if($value < 0)
        {
            $answer = "-" . $answer;
        }

        return $answer;
    }
}