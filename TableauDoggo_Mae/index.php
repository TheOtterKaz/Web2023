<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/x-icon" href="img/niche.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link rel="stylesheet" href="styleIndex.css">
    
    <title>Tableau de chiens</title>
</head>

<body>
   <?php

// Message  
        $couleur = $message = "";

//Verification du message
        if(isset($_GET["action"]))
            {
                if($_GET["action"] == "modifierOk")
                    {
                        $message = "Le chien a été modifié";
                        $couleur = "success";
                    }
                elseif($_GET["action"] == "modifierErreur")
                    {
                        $message = "Le chien n'a pas été modifié. Réessayer svp.";
                        $couleur = "danger";
                    }
                elseif($_GET["action"] == "ajouterOk")
                    {
                        $message = "Le chien a été ajouté";
                        $couleur = "success";
                    }
                elseif($_GET["action"] == "ajouterErreur")
                    {
                        $message = "Le chien n'a pas été ajouté. Réessayer svp.";
                        $couleur = "danger";
                    }
            }

            
        // connexion
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "travaux";

        // creation de la connexion
        $conn = new mysqli($servername, $username, $password, $db);

        // check de la connexion
        if ($conn->connect_error)
            {
                die("La connexion n'a pas fonctionné" . $conn->connect_error);
            }

        // Permet de transformer en utf8
        $conn->query('SET NAMES utf8');
        
        // lecture des données
        $sql = "SELECT * FROM doggo2";
        $result = $conn->query($sql);

        // verification des données dans le tableau
        if ($result->num_rows > 0)
            {
    ?>
            <div class="container-fluid ">
                <div class="row">
                    <div class="offset col-xl-3"></div>
                    <div class="col-xl-6">
                        <table class="mt-4">
                            <thead>
<!-- Ligne du debut avec les titres -->
                                <tr class="bg-info bg-opacity-75 text-center">
                                    <th scope="col" class="px-3 py-3">#</th>
                                    <th scope="col" class="px-3 py-3">Race</th>
                                    <th scope="col" class="px-3 py-3">Pays</th>
                                    <th scope="col" class="px-3 py-3">Caractère</th>
                                    <th scope="col" class="px-3 py-3">Couleur</th>
                                    <th scope="col" class="px-3 py-3">Image</th>
                                    <th scope="col" class="px-3 py-3">Tools</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                    <?php
// prendre les données de chaque ligne 
            while($row = $result->fetch_assoc())
                {
                    ?>    
                    <tr class="text-center border border-light border-3 bg-info-subtle bg-opacity-25">     
<!-- colonne avec le id-->
                        <th scope="row" class="px-3 py-4"><?php echo $row["id"] ?></th>
<!-- autres colonnes -->
                        <td class="px-3 py-4"><?php echo $row["Race"] ?></td>
                        <td class="px-3 py-4"><?php echo $row["Pays"] ?></td>
                        <td class="px-3 py-4"><?php echo $row["Caractere"] ?></td>
                        <td class="px-3 py-4"><?php echo $row["Couleur"] ?></td>
                        <td class="px-3 py-4"><img src="<?php echo $row["Image"]?>" class="rounded border border-3 border-info border-opacity-75"></td>
<!-- colonne des boutons-->
                        <td>
                            <div class="d-flex justify-content-between flex-column px-3 py-3">
                                <a href="modifier.php?id=<?php echo $row["id"] ?>">
                                    <img src="img/modifier.png" alt="modifier" height="50">  
                                </a>
                                <br>
                                <a href="supprimer.php?id=<?php echo $row["id"] ?>">
                                    <img src="img/supprimer.png" alt="supprimer" height="50">                              
                                </a>                        
                            </div>
                        </td>   
                    </tr>                
                    <?php
                }
                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="offset col-xl-3"></div>
                    </div>

                    <div class="row">
                        <div class="offset col-xl-4"></div>
                        <div class="col-xl-4 text-center mt-4">
                            <a href="ajouter.php" class="btn btn-info btn-opacity-75 py-2 px-4">
                                <div class="d-flex align-content justify-content-evenly">                                     
                                    <span><img src="img/ajouter.png" alt="ajouter" height="45" class="pe-2">Ajouter un chien</span>
                                </div>
                            </a>
                        </div>
                        <div class="offset col-xl-4"></div>
                    </div>
            </div>
            <?php
            }
        else 
        {
            echo "Aucun résultat";
        }
        
        $conn->close();
   ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>