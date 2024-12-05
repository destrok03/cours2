<?php

/*
 
    Declaration de Variable  sont dynamiques ie pas type
     //Type 
        //Primitifs int ,float ,string,boolean,null
        //Composes  array(tableau),object,Ressources

     $nomVariable;
*/


$x = 2;  //x est un entier
$x = 1.2; //x est un reel
$x = true; //x est boolean
$x = "Bonjour"; //x est une chaine
$x = 'Bonjour'; //x est une chaine
$x = null; //x n'a pas encore de valeur


//Expressions
/*
  *Operateurs 
    Arithmetiques(+,-,*,/,%) 
    operator affectation (=)
    operator Compaparaison (>,<,>=,<=,==,!=,===)
    operator Logique (and(&&), or(||),!)
  */

$x = 1;
$y = 1;
$z = $x + $y; //2
$ok = $x > $y; //false

$f = "1";
//Concateination
$k = $x + $f;  //$k="11";
$ok = $x == $y; //true
//operateur == est un operateur de comparaison se basant sur les valeurs et pas sur les types
$ok = $x == $f; //1=="1" ==>true 
//operateur == est un operateur de comparaison se basant sur les valeurs et  sur les types
$ok = $x === $f;//1==="1" ==>false 