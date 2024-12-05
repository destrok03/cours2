<?php
//Ecrire un programme qui permet la saisie d’un nombre entier positif puis affiche  la table de multiplication de ce nombre.
//fonction saisie un nombre positif  
function saisieNombre()
{
    do {
        $nbre = (int)readline("Entrer un nombre\n");
    } while ($nbre  <= 0);
    return $nbre;
}
//procedure affiche la table de multiplication
function tableMultiplication($nombre)
{
    for ($i = 1; $i <= 10; $i++) {
        printf("%d * %d=%d\n", $nombre, $i, $i * $nombre);
    }
}

//appel 
$nombre = saisieNombre();
tableMultiplication($nombre);
