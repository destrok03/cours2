<?php 
//Fonctions Access aux donnees
   function selectClients():array {
    return
        [
            [
            "nom"=>"Wane",
            "prenom"=>"Baila",
            "telephone"=>"777661010",
            "adresse"=>"FO",
            "dettes" => []

            ], 
            [
            "nom"=>"Wane1",
            "prenom"=>"Baila1",
            "telephone"=>"777661011",
            "adresse"=>"FO1",
            "dettes" => [
                [
                    "montdette" => 5000,
                    "datepret"=> "12-10-2012",
                    "echeance" => "12-10-2023",
                    "ref"=>"1234",
                    "montverse" => 2500,
                    "paiement"=>[
                        [
                            "ref"=>"1235",
                            "date"=> "12-12-2012",
                            "montantpaie"=> "2500"
                        ],
                        [
                            "ref"=>"123",
                            "date"=> "12-11-2015",
                            "montantpaie"=> "2500"
                        ]
                        
                    ]
                ],
                [
                    "montdette" => 5000,
                    "datepret"=> "12-10-2012",
                    "echeance" => "12-10-2023",
                    "ref"=>"1234",
                    "montverse" => 2500,
                    "paiement"=>[
                    "ref"=>"1234",
                    "date"=> "12-11-2012",
                    "montantpaie"=> "2500"
                    ]
                ]
            ]

            ]
        ];


   }

   function selectClientByTel(array $clients,string $tel):array|null {
        foreach ($clients as  $client) {
            if ($client["telephone"] == $tel) {
               return $client;
            }
        }
        return null;
   }

   function insertClient(array &$tabClients,$client):void {
          // array_push($tabClients,$client);
           $tabClients[]=$client;
      }




//Fonctions Services ou Use Case  ou Metier
  function  enregistrerClient(array &$tabClients,array $client):bool{
     $result=  selectClientByTel($tabClients,$client["telephone"]);
     if (  $result==null ) {
        insertClient($tabClients,$client);
        return true;
     }
     return false;
  }

  function listerClient():array{
      return selectClients();
  }


function estVide(string $value):bool{
    //$value=="" ou empty($value)
    return empty($value);
}




//Fonctions Presentation
function saisieChampObligatoire(string $sms):string{
    do {
        $value= readline($sms);
    } while (estVide($value));
   return $value;
}
function telephoneIsUnique(array $clients,string $sms):string{
    do {
        $value= readline($sms);
    } while (estVide($value) || selectClientByTel($clients,$value)!=null);
    return $value;
   
}

function afficheClient(array $clients):void{
    if (count($clients)==0) {
        echo "Pas de client a affiche";
    }else {
        foreach ($clients as  $client) {
            echo"\n-----------------------------------------\n";
            echo "Telephone : ". $client["telephone"]."\t";
            echo "Nom : ". $client["nom"]."\t";
            echo "Prenom : ". $client["prenom"]."\t";
            echo "Adresse : ". $client["adresse"]."\t";
      }
    }
    
}



function saisieClient(array $clients):array{
    return [
        "telephone"=>telephoneIsUnique($clients,"Entrer le Telephone: "),
         "nom"=>saisieChampObligatoire(" Entrer le Nom: "),
         "prenom"=>saisieChampObligatoire(" Entrer le Prenom: "),
         "adresse"=>saisieChampObligatoire(" Entrer l'Adresse: "),
         "dettes"=>[]
    ] ; 
}

function menu():int{
    echo "
     1.Ajouter client \n
     2.Lister les clients\n 
     3.enregistre dette\n
     4.lister dette dun client\n
     5.payer dette du client
     6. filter par telephone \n
     7.quitter";
     
    return (int)readline(" Faites votre choix: ");
}
function confirmer(string $sms):bool{
    do {
        $rep = readline($sms);
    } while ($rep!= "O" && $rep!= "N");
    return $rep == "O";
}
function verifMontant(string $sms) {
    do {
        $montant = (float)readline($sms);
    } while ($montant<=0);
    return $montant;
}
function saisieDette(): array
{
    return [
        "montdette" => verifMontant("entrer le montant de la dette: "),
        "datepret" => saisieChampObligatoire(" Entrer la Date du pret: "),
        "echeance" => saisieChampObligatoire(" Entrer la Date limite de paiement: "),
        "ref" => uniqid(), // Génération automatique de la référence
        "montverse" => 0, // Initialisation du montant versé à 0
        "paiement" => []
    ];
}
function insertDettes(array &$tabClients,array $tabDette,$index ):void{
    $tabClients[$index]["dettes"] = $tabDette;
 }
 function indexClientByTel(array $clients,string $tel):int {
    foreach ($clients as  $index =>$client) {
        if ($client["telephone"] == $tel) {
           return $index;
        }
    }
    return -1;
}
function listerDettesByClient(string $numero, array $tabDette) {
    $clientTrouve = false;
    foreach ($tabDette as $dette) {
        if ($dette["telephone"] === $numero) {
            if (!$clientTrouve) {
                // Afficher les informations du client une seule fois
                echo "Téléphone : " . $numero . "\n";
                $clientTrouve = true;
            }

            // Afficher les détails de la dette
            echo "-----------------------------------------\n";
            echo "Référence de la dette : " . $dette["ref"] . "\n";
            echo "Montant : " . $dette["montdette"] . " €\n";
            echo "Date du prêt : " . $dette["datepret"] . "\n";
            echo "Date d'échéance : " . $dette["echeance"] . "\n";
            echo "Montant versé : " . $dette["montverse"] . " €\n";
            // ... Ajouter d'autres informations si nécessaire (solde restant, etc.)
        }
    }
    if (!$clientTrouve) {
        echo "Aucun client trouvé avec ce numéro de téléphone.";
    }
}
 
function payerDette(array &$clients, string $tel, string $refDette, float $montant) {
    $indexClient = indexClientByTel($clients, $tel);

    if ($indexClient === -1) {
        return "Client non trouvé.";
    }

    foreach ($clients[$indexClient]["dettes"] as &$dette) {
        if ($dette["ref"] === $refDette) {
            if ($montant <= 0) {
                return "Le montant du paiement doit être positif.";
            }

            $dette["montverse"] += $montant;
            $dette["paiement"][] = [
                "reference" => uniqid("PAY_"),
                "montant" => $montant,
                "date" => date("Y-m-d")
            ];

            // Calcul du solde restant
            $dette["soldeRestant"] = $dette["montdette"] - $dette["montverse"];

            return "Paiement enregistré avec succès.";
        }
    }

    return "Dette non trouvée.";
}
function filtrerClientsParPrefixe(array $clients, string $prefixeRecherche): array {
    $clientsFiltres = [];
    $regex = '/^' . preg_quote($prefixeRecherche, '/') . '/i'; 

    foreach ($clients as $client) {
        if (preg_match($regex, $client['telephone'])) {
            $clientsFiltres[] = $client;
        }
    }
    return $clientsFiltres;
}


function principal(){
   $clients= selectClients();
   do {

      $choix= menu();
      switch ($choix) {
       case 1:
        $client=saisieClient($clients);
       if (enregistrerClient($clients,$client)) {
           echo"Client Enregistrer avec success \n";
           if(confirmer("voulez vous enregistrer une dette")){
             insertDettes($clients,saisieDette(),strlen($clients)-1);
           }
       }else {
            echo"Le numero Telephone  existe deja \n";
       }
       break;
       case 2:
        afficheClient( $clients);
       break;
       case 3:
        $tel= readline("entrer le numero de telephone");
           if (indexClientByTel($clients,$tel)!= -1){
                $dette = saisieDette();
                insertDettes($clients,$dette,indexClientByTel($clients,$tel));
           }
           else{
             echo "Le numero Telephone  n'existe pas \n";
           }
       break;
       case 4:
           $numero = readline("entrer le numero");
           $client = selectClientByTel($clients,$numero);
           if($client){
             listerDettesByClient($numero,$client["dettes"]);
           } else {
             echo "Le numero Telephone  n'existe pas \n";
           }
           break;
           
       case 5:
        $tel= readline("entrer le numero de telephone");
        $refDette= readline("entrer la reference de la dette");
        $montant= (float)readline("entrer le montant du paiement");
        echo payerDette($clients,$tel,$refDette,$montant);
       break;
       case 6:
                    echo "Choisissez un préfixe :\n";
                echo "1. 77\n";
                echo "2. 76\n";
                echo "3. 70\n";
                $choixPrefixe = readline("Votre choix : ");

                switch ($choixPrefixe) {
                    case '1':
                        $prefixeARechercher = '77';
                        break;
                    case '2':
                        $prefixeARechercher = '76';
                        break;
                    case '3':
                        $prefixeARechercher = '70';
                        break;
                    default:
                        echo "Choix invalide.\n";
                        return;
                }
                $clientsTrouves = filtrerClientsParPrefixe($clients, $prefixeARechercher);
                afficheClient($clientsTrouves);
                break;
        default:
        echo "Choix invalide.\n";
    
      }

   } while ($choix!=7);
}
principal();