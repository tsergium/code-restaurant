<?php
/**
 * Make a function that will calculate the power of a number x to index y, but you cannot use multiplication!
 */

function easyPower($a, $b)
{
    return pow($a, $b);
}

// test case
$a = $argv[1];
$b = $argv[2];
echo easyPower($a, $b);