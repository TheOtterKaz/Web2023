<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="img/ajouter_fav.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Ajout d'un chien</title>
</head>

<body>
    <?php
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

// variables pour les méthodes
        $race = $pays = $caract = $coul = $img = "";            
        $raceErr = $paysErr = $caractErr = $coulErr = $imgErr = "";    
        $erreur = false;

// Methode pour vérifier les données entrées    
        if($_SERVER["REQUEST_METHOD"] == "POST")
            {
        // race
                if(empty($_POST["race"]))
                    {
                        $raceErr = "Veuillez entrer une race";
                        $erreur = true;
                    }
                else 
                    {
                        $race = test_input($_POST["race"]);
                    }
            
    // pays
                if(empty($_POST["pays"]))
                    {
                        $paysErr = "Veuillez entrer un pays";
                        $erreur = true;
                    }
                else 
                    {
                        $pays = test_input($_POST["pays"]);
                    }
           
    // caractère
                if(empty($_POST["caract"]))
                    {
                        $caractErr = "Veuillez entrer un trait de caractère";
                        $erreur = true;
                    }
                else 
                    {
                        $caract = test_input($_POST["caract"]);
                    }
            
    // couleur
                if(empty($_POST["couleur"]))
                    {
                        $coulErr = "Veuillez entrer une couleur";
                        $erreur = true;
                    }
                else 
                    {
                        $coul = test_input($_POST["couleur"]);
                    }
    // Image
                if(empty($_POST["image"]))
                    {
                        $imgErr = "Veuillez entrer une image";
                        $erreur = true;
                    }
                else if(!empty($_POST["image"]) && !filter_var($_POST["image"], FILTER_VALIDATE_URL))
                    {
                        $imgErr = "Veuillez mettre un lien URL";
                        $erreur = true;
                    }    
                else 
                    {
                        $img = test_input($_POST["image"]);
                    }
           

    // si aucune erreur 
                if($erreur == true)
                    {
    ?>
                        <div class="row">
                            <div class="offset col-xl-4"></div>
                                <div class="col-xl-4 alert alert-danger text-center fw-bold mt-4">
                                    Veuillez corriger les différentes erreurs
                                </div>
                            <div class="offset col-xl-4"></div>
                        </div>
    <?php
                    }
                else 
                    {
                        $sql = "INSERT INTO doggo2 (race, pays, caractere, couleur, image) VALUES ('$race', '$pays', '$caract', '$coul', '$img')";

                        if(mysqli_query($conn, $sql))
                            {
                                echo "<div class='alert alert-succes'>Le nouveau chien a été ajouté</div>";
                                header("Location: index.php?action=ajouterOk");
                            }
                        else 
                            {
                                echo "Erreur" . $sql . "<br>" . mysqli_error($conn);
                                header("Location: index.php?action=ajouterErreur");
                            }
                    }
        }        
    ?>

<!-- formulaire d'ajout-->
    <div class="row">
        <div class="offset col-xl-4"></div>
            <div class="col-xl-4">
<!-- permet de rappeler la meme page-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="card mt-4 border border-1 border-info">
<!-- Partie du titre -->                        
                        <div class="card-header border-bottom border-2 border-info bg-info bg-opacity-75 text-center">
                            <h3 class="px-3 py-3 m-0">Ajout d'un chien</h3>
                        </div>

                        <div class="card-body bg bg-gradient bg-info-subtle bg-opacity-25">
<!-- Race -->
                            <div class="d-flex justify-content-between px-4 py-3">
                                <label for="race" class="fw-bold">Race</label>
                                <input type="text" name="race" placeholder="Beagle" class="w-75 rounded border border-1 border-<?php if($raceErr != ""){echo "danger";}else{echo "info";}?> text-center">
                            </div>
<!-- Pays -->                    
                            <div class="d-flex justify-content-between px-4 py-3">
                                <label for="pays" class="fw-bold">Pays</label>
                                <input type="text" name="pays" placeholder="Canada" class="w-75 rounded border border-1 border-<?php if($paysErr != ""){echo "danger";}else{echo "info";}?> text-center">
                            </div>
<!-- Caractère -->                    
                            <div class="d-flex justify-content-between px-4 py-3">
                                <label for="caract" class="fw-bold">Caractère</label>
                                <input type="text" name="caract" placeholder="Affectueux" class="w-75 rounded border border-1 border-<?php if($caractErr != ""){echo "danger";}else{echo "info";}?> text-center">
                            </div>
<!-- Couleur -->                    
                            <div class="d-flex justify-content-between px-4 py-3">
                                <label for="couleur" class="fw-bold">Couleur</label>
                                <input type="text" name="couleur" placeholder="Noir et Feu" class="w-75 rounded border border-1 border-<?php if($coulErr != ""){echo "danger";}else{echo "info";}?> text-center">
                            </div>
<!-- Image -->                    
                            <div class="d-flex justify-content-between px-4 py-3">
                                <label for="image" class="fw-bold">Image</label>
                                <input type="text" name="image" class="w-75 rounded border border-1 border-<?php if($imgErr != ""){echo "danger";}else{echo "info";}?>">
                            </div>
                        </div>

                        <!-- bouton d'ajout -->
                            <div class="card-footer border-top border-2 border-info bg bg-info bg-opacity-50 bg-gradient">
                                <div class="d-grid gap-2 d-flex justify-content-evenly">
<!-- bouton retour accueil -->
                                    <a href="index.php" class="btn btn-info text-dark border border-1 border-dark col-xl-6">
                                        <div class="d-flex align-content-center justify-content-evenly">
                                            <span class="fw-bold"><img src="img/retour.png" alt="retour" height="30" class="pe-2">Retour</span>
                                        </div>
                                    </a>
<!-- bouton ajouter -->
                                    <button class="btn btn-info text-dark col-xl-6 border border-1 border-dark" type="submit">
                                        <div class="d-flex align-content-center justify-content-evenly">
                                            <span class="fw-bold"><img src="img/enregistrer.png" alt="retour" height="30" class="pe-2">Enregistrer</span>
                                        </div>
                                    </button>
                                </div>
                                
                            </div>
                    </div>
                </form>
            </div>
        <div class="offset col-xl-4"></div>
    </div>

<!-- fonction pour la sécurité -->
    <?php 
        function test_input($data)
            {
                $data = trim($data);
                $data = addslashes($data);
                $data = htmlspecialchars($data);
                return $data; 
            }
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>