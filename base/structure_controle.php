<?php
$age = 12;
if ($age < 18) {
    echo "Mineur";
} else {
    echo "Majeur";
}

//Switch case 

$a = 12;
$b = 10;
$op = "+";//+ ou -

switch ($op) {
    case '+':
        $result = $a + $b;
        break;
    case '-':
        $result = $a - $b;
        break;
    default:
        $result='Erreur operateur';
        break;
}

echo $result;
//--if 
if ($op=='+') {
    $result = $a + $b;
} else {
   if ($op=='-') {
    $result = $a - $b;
   } else {
    $result='Erreur operateur';
   }
   
}
