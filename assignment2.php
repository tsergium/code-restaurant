<?php
/**
 * Make a function that will calculate the power of a number x to index y, but you cannot use multiplication!
 *
 * you can call the script like this
 * user@host: php assignment2.php 2 10
 */

// 2 possible methods, using pow or multiple sums like 5 to the power of 3 is ((5+5+5+5+5) = 25+25+25+25+25) = 125

function easyPower($a, $b)
{
    return pow($a, $b);
}

// test case
$a = $argv[1];
$b = $argv[2];
echo easyPower($a, $b);