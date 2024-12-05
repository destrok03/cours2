<?php
//Tableaux 
//Vecteurs
//1-Tableau n'ont pas de taille predefinie
//2-Tableau n'ont pas de type
//0   1     2        3 index du tableau
$tableau = [1, 4.5, "Table", true];
//echo $tableau[0]; //1
//echo $tableau[3]; //true

//boucle du tableau
for ($i = 0; $i < 4; $i++) {
    printf("%d\t", $tableau[$i]);
}
//count($tableau):retourne la taille du tableau
printf("\nNbre element du tableau %d\n", count($tableau));

for ($i = 0; $i < count($tableau); $i++) {
    printf("%d\t", $tableau[$i]);
}

foreach ($tableau as $index => $value) {
    printf("%d\t", $value);
}


  //Tableaux de tableaux