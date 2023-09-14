<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="img/ajouter_fav.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Modifier un chien</title>
</head>

<body>
    <?php
// Variables 
        $race = $pays = $caractere = $couleur = $image = "";            
        $raceErr = $paysErr = $caractErr = $coulErr = $imgErr = "";    
        $erreur = false;
        $formAfficher = "none";
        

// connexion
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname = 'travaux';

// variable globale
        global $id;

// creation de la connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

// Permet de transformer en utf8
        $conn->query('SET NAMES utf8');

// Recherche de la donnée
        if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM doggo2 WHERE id = $id";
                $result = $conn->query($sql);

                if($result->num_rows > 0)
                    {
                        $row = $result->fetch_assoc();
                    }

                $formAfficher = "block";
            }
        elseif(isset($_POST['id']))
            {
                $id = $_POST['id'];                
            }

// check de la connexion
        if(!$conn)
            {
                die("La connexion n'a pas fonctionné" . mysqli_connect_error());
            }
               
// Verification des données
        if($_SERVER["REQUEST_METHOD"] == "GET")
            {
                $race = $row['Race'];
                $pays = $row['Pays'];
                $caractere = $row['Caractere'];
                $couleur = $row['Couleur'];
                $image = $row['Image'];
            }
        
        if($_SERVER["REQUEST_METHOD"] == "POST")
            {
            // race
                if(empty($_POST['Race']))
                    {
                        $raceErr = "Veuillez entrer une race";
                        $erreur = true;
                    }
                else
                    {
                        $race = test_input($_POST['Race']);
                    }

            // pays
                if(empty($_POST['Pays']))
                    {
                        $paysErr = "Veuillez entrer un pays";
                        $erreur = true;
                    }
                else
                    {
                        $pays = test_input($_POST['Pays']);
                    }

            // caractère
                if(empty($_POST['Caractere']))
                    {
                        $caractErr = "Veuillez entrer un trait de caractère";
                        $erreur = true;
                    }
                else
                    {
                        $caractere = test_input($_POST['Caractere']);
                    }

            // couleur
                if(empty($_POST['Couleur']))
                    {
                        $coulErr = "Veuillez entrer une couleur";
                        $erreur = true;
                    }
                else
                    {
                        $coul = test_input($_POST['Couleur']);
                    }

            // image
                if(empty($_POST['Image']))
                    {
                        $imgErr = "Veuillez entrer une image";
                        $erreur = true;
                    }
                elseif(!empty($_POST['Image']) && !filter_var($_POST['Image'], FILTER_VALIDATE_URL))
                    {
                        $imgErr = "Veuillez entrer un lien valide";
                        $erreur = true;
                    }
                else
                    {
                        $img = test_input($_POST['Image']);
                    }

            // si tout est valide
                if($erreur == true)
                    {
    ?>
                        <div class="row">
                            <div class="offset col-xl-4"></div>
                            <div class="col-xl-4 fw-bold text-center alert alert-danger">Veuillez corriger les erreurs</div>
                            <div class="offset col-xl-4"></div>
                        </div>
    <?php
                    }
                else
                    {
                        $sql = "UPDATE doggo2 SET Race='$race', Pays='$pays', Caractere='$caractere', Couleur='$couleur', Image='$image' WHERE id=$id";

                        if(mysqli_query($conn, $sql))
                            {
                                echo "<div class='alert alert-succes'>Le chien a été modifié</div>";
                                header("Location: index.php?action=modifierOk;");
                            }
                        else
                            {
                                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
                                header("Location: index.php?action=modifierErreur");
                            }
                    }
            }
    ?>

<!-- formulaire de modification -->
        <div class="container-fluid" style="visibility: <?php echo '$FormAfficher'?>;">
            <div class="row">
                <div class="offset col-xl-4"></div>
                    <div class="col-xl-4">
                        <div class="card mt-4 border border-1 border-info">
                            <!-- titre -->
                                                        <div class="card-header border-bottom border-2 border-info bg bg-info bg-opacity-75 text-center">
                                                            <h3 class="px-3 py-3 m-0">Modifier un chien</h3>
                                                        </div>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<!-- elements a modifier -->
                                <div class="card-body bg bg-gradient bg-info-subtle bg-opacity-25">
<!-- id -->
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <label for="id" class="fw-bold">ID</label>
                                        <input type="text" name="id" value="<?php echo $id ?>"readonly class="w-75 text-center rounded border border-1 border-info">
                                    </div>
<!-- race -->
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <label for="race" class="fw-bold">Race</label>
                                        <input type="text" name="race" value="<?php if($race != ""){echo $race;} ?>" class="w-75 text-center rounded border border-1 border-<?php if($raceErr != ""){echo "danger";}else{echo "info";}?>">
                                    </div>
<!-- pays -->
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <label for="pays" class="fw-bold">Pays</label>
                                        <input type="text" name="pays" value="<?php if($pays != ""){echo $pays;} ?>" class="w-75 text-center rounded border border-1 border-<?php if($paysErr != ""){echo "danger";}else{echo "info";}?>">
                                    </div>
<!-- caractere -->
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <label for="caractere" class="fw-bold">Caractère</label>
                                        <input type="text" name="caractere" value="<?php if($caractere != ""){echo $caractere;} ?>" class="w-75 text-center rounded border border-1 border-<?php if($caractErr != ""){echo "danger";}else{echo "info";}?>">
                                    </div>
<!-- couleur -->
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <label for="couleur" class="fw-bold">Couleur</label>
                                        <input type="text" name="coul" value="<?php if($couleur != ""){echo $couleur;} ?>" class="w-75 text-center rounded border border-1 border-<?php if($coulErr != ""){echo "danger";}else{echo "info";}?>">
                                    </div>
<!-- image -->
                                    <div class="d-flex justify-content-between px-4 py-3">
                                        <label for="image" class="fw-bold">Image</label>
                                        <input type="text" name="image" value="<?php if($image != ""){echo $image;} ?>" class="w-75 text-center rounded border border-1 border-<?php if($imgErr != ""){echo "danger";}else{echo "info";}?>">
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
                                </form>
                                </div>
                        </div>
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