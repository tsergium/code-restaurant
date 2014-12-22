<?php
/**
 * Make a function that will calculate the power of a number x to index y, but you cannot use multiplication!
 *
 * you can call the script like this
 * user@host: php assignment2.php 2 10
 */

/**
 * 3 possible methods
 * using pow function
 * using multiple sums like 5 to the power of 3 is ((5+5+5+5+5) = 25+25+25+25+25) = 125
 * using division number / (1 / $number)
 */

function easyPower($a, $b)
{
    if($a == 0)
    {
        return 0;
    }
    elseif($b == 0)
    {
        return 1;
    }

    $currentSum = $a;
    for($i = 1; $i < $b; $i++)
    {
        $sum = 0;
        for($j = 1; $j <= $a; $j++)
        {
            $sum += $currentSum;
        }
        $currentSum = $sum;
    }
    return $sum;
}

// test case
$a = $argv[1];
$b = $argv[2];
echo easyPower($a, $b);