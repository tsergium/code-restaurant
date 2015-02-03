<pre>
&lt;?php
/**
 * find the sum of all the multiples of 3 or 5 below 1000 in an algorithmic approach
 * then do the same thing for 3 and 4
 * script must be callable from the CLI
 *
 * you can call the script like this
 * user@host: php assignment1.php 3 5 1000
 * user@host: php assignment1.php 3 5 1000 and
 */

$firstNumber = $argv[1];
$secondNumber = $argv[2];
$maxNumber = $argv[3];

function sumMultiplesOr($firstNumber, $secondNumber, $maxNumber)
{
    $sum = 0;
    for ($i = 0; $i < $maxNumber; $i++)
    {
        if (!($i % $firstNumber) || !($i % $secondNumber))
        {
            $sum += $i;
        }
    }
    return $sum . "\n\r";
}

function sumMultiplesAnd($firstNumber, $secondNumber, $maxNumber)
{
    $sum = 0;
    for ($i = 0; $i < $maxNumber; $i++)
    {
        if (!($i % $firstNumber) && !($i % $secondNumber))
        {
            $sum += $i;
        }
    }
    return $sum . "\n\r";
}

// test case
if(isset($argv[4]) && $argv[4] == 'and')
{
    echo sumMultiplesAnd($firstNumber, $secondNumber, $maxNumber);
}
else
{
    echo sumMultiplesOr($firstNumber, $secondNumber, $maxNumber);
}
</pre>