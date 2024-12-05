<?php
/*
Ecrire un programme qui permet de saisir une serie de notes puis determine : 
 -La note la plus grande 
 -la note plus petite 
 -la moyenne  des notes 
 NB : la saisie s'arrete si l'utilisateur  donne la reponse non 
 */

function sasieNote()
{
    do {
        $note = (float)readline("Entrer une note\n");
    } while ($note < 0 || $note > 20);
    return $note;
}

//procedure
function calcul(&$min, &$max, &$moyenne)
{
    $somme = 0;
    $nbreNote = 0;
    do {
        $rep = readline("Voulez vous saisir une note(O/N)\n");
        if ($rep == "O") {
            $note = sasieNote();
            $nbreNote++;
            $somme = $somme + $note;
            if ($min > $note) {
                $min = $note;
            }
            if ($max < $note) {
                $max = $note;
            }
        }
        # code...
    } while ($rep == "O");
    $moyenne = $somme / $nbreNote;
}

$min = 20;
$max = 0;
$moyenne;
calcul($min, $max, $moyenne);
printf("Min: %f\n", $min);
printf("Max: %f\n", $max);
printf("Moyenne: %f\n", $moyenne);


