<?php
//fonction ou procedures 
//php ==> fonction !void , fonction void

//fonction
function somme($x, $y)
{
    $somme = $x + $y;
    return $somme;
}

//appel 
$s = somme(12, 23);

//procedure
function somme1($x, $y)
{
    echo $x + $y;
}
//appel 
$a = 12;
$b = 15;
somme1($a, $b);


//procedure
//&$somme est une donne/resultat
function somme2($x, $y, &$somme)
{
    $somme = $x + $y;
}
