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

//fonctions en php peuvent retourner des tableaux
function sasieTableau()
{
    $tableauNotes = [];
    do {
        $rep = readline("Voulez vous saisir une note(O/N)\n");
        if ($rep == "O") {
            //remplir le tableau vers la fin
            $tableauNotes[] = sasieNote();
        }
        # code...
    } while ($rep == "O");
    return $tableauNotes;
}

function afficheTableau($tableauNotes)
{
    for ($i = 0; $i < count($tableauNotes); $i++) {
        printf("%d %d\t", $i, $tableauNotes[$i]);
    }
}
//procedure
function calcul($tableauNotes, &$min, &$max, &$moyenne)
{
    $somme = 0;

    foreach ($tableauNotes as  $value) {
        $somme = $somme + $value;
        if ($min > $value) {
            $min = $value;
        }
        if ($max < $value) {
            $max = $value;
        }
    }
    $moyenne = $somme / count($tableauNotes);
}

$min = 20;
$max = 0;
$moyenne;
$notes = sasieTableau();
afficheTableau($notes);
printf("\n");
calcul($notes, $min, $max, $moyenne);
printf("Min: %f\n", $min);
printf("Max: %f\n", $max);
printf("Moyenne: %f\n", $moyenne);
