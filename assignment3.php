<?php
/**
 * Calculate and print 10 numbers for fibonacci series. Use recursion.
 * Extra: Create second algorithm for fibonacci but without recursion.
 *
 * you can call the script like this
 * user@host: php assignment3.php 21
 * user@host: php assignment3.php 21 rec
 * @param $n
 * @param int $previous
 * @param int $sum
 */

// 0	1	1	2	3	5	8	13	21	34	55	89	144	233	377	610	987	1597	2584	4181	6765

function fibonacciRec($n, $previous = 0, $sum = 1)
{
    if($n>0)
    {
        $var = $previous;
        $previous = $sum;
        $sum = $sum + $var;
        echo $var . "\n\r";
        fibonacciRec($n-1, $previous, $sum);
    }
    return;
}

function fibonacci($n)
{
    $previous = 0;
    $sum = 1;
    for($i = 0; $i < $n; $i++)
    {
        $var = $previous;
        $previous = $sum;
        $sum = $sum + $var;
        echo $var . "\n\r";
    }
    return;
}

// test case
if(isset($argv[2]) && $argv[2] == 'rec')
{
    echo fibonacciRec($argv[1]);
}
else
{
    echo fibonacci($argv[1]);
}