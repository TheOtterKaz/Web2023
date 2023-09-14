<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Création d'un usager</title>
</head>

<body>
    <?php
        // variable vide
        $nom = $mdp1 = $mdp2 = $courriel = $lien = $btnS = $dateNaiss = $moyTp = "";

        // variable des erreurs
        $nomErr = $mdp1Err = $mdp2Err = $courrielErr = $lienErr = $btnSErr = $dateNaissErr = $moyTpErr = "";
        $erreur = false;

        // Visiblité formulaire
        $dispForm = "block";
        $dispCard = "none";

        // validation de chaque champ       
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // Nom d'usager
            if(empty($_POST['nomUser']))
                {
                    $nomErr = "Nom d'usager invalide";
                    $erreur = true;
                }
            else if(!empty($_POST['nomUser']) && $_POST['nomUser'] == "SLAY")
                {
                    $nomErr = "Nom d'usager déjà utilisé";
                    $erreur = true;
                }
            else
                $nom = test_input($_POST['nomUser']);
                
            // Mot de passe
            if(empty($_POST['mdp1']))
                {
                    $mdp1Err = "Mot de passe invalide";
                    $erreur = true;
                }
            else
                $mdp1 = test_input($_POST['mdp1']);
                
            // Confirmation mot de passe
            if(empty($_POST['mdp2']))
                {
                    $mdp2Err = "Confirmation invalide";
                    $erreur = true;
                }
            else if(($_POST['mdp2'] != $mdp1) && ($mdp1 != ""))
                {
                    $mdp2Err = "Mot de passe différent";
                    $erreur = true;
                }
            else
                $mdp2 = test_input($_POST['mdp2']);

            // Courriel
            if(empty($_POST['courriel']))
                {
                    $courrielErr = "Courriel invalide";
                    $erreur = true;
                }
            else
                $courriel = test_input($_POST['courriel']);

            // lien avatar
            if(empty($_POST['lienAvatar']))
                {
                    $lienErr = "Lien URL invalide";
                    $erreur = true;
                }
            else if(!empty($_POST['lienAvatar']) && !filter_var($_POST['lienAvatar'], FILTER_VALIDATE_URL))
                {
                    $lienErr = "Lien URL non valide";
                    $erreur = true;
                }
            else
                $lien = test_input($_POST['lienAvatar']);

            // Bouton radio Sexe
            if(empty($_POST['btnS']))
                {
                    $btnSErr = "Sexe invalide";
                    $erreur = true;
                }
            else
                $btnS = test_input($_POST['btnS']);

            // Date de naissance
            if(empty($_POST['dateNaiss']))
                {
                    $dateNaissErr = "Date de naissance invalide";
                    $erreur = true;
                }
            else if($_POST['dateNaiss'] >= date("Y-m-d"))
                {
                    $dateNaissErr = "Date impossible";
                    $erreur = true;
                }    
            else
                $dateNaiss = test_input($_POST['dateNaiss']);            

            // Moyen de transport
            if($_POST['moyTp'] == "nonValide")
                {
                    $moyTpErr = "Moyen de transport invalide";
                    $erreur = true;
                }
            else
                $moyTp = test_input($_POST['moyTp']);      


            // Si tout est valide
            if($erreur == false)
                {
                    $dispForm = "none";
                    $dispCard = "block";
                }
            else 
                {
                    $dispForm = "block";
                    $dispCard = "none";                    
                }
        }
    ?>

    <div class="container-fluid" style="display:<?php echo $dispForm?>" id="Form">
        <div class="row">
            <div class="offset col-xl-4"></div>
            <div class="col-xl-4">
                <div class="card mt-3 border border-info bg-info bg-gradient bg-opacity-10">

                    <!-- Titre du formulaire  -->
                    <div class="card-header text-center bg-info bg-gradient bg-opacity-50 fw-bold">
                        <h2>Création d'un nouvel usager</h2>
                    </div>

                    <!-- Informations dans le formulaire  -->
                    <div class="card-body">

                                            <!-- Permet de se rappeler lui-meme  -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <!-- Nom usager  -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Nom d'usager <span><?php echo $nomErr; ?></span></p> <input type="text" name="nomUser" placeholder="Ex. JaneDoe87" value="<?php if($nomErr != ""){echo $_POST['nomUser'];}else{echo "";}?>" class="bg-light bg-gradient border border-1 rounded border-<?php if($nomErr != ""){echo "danger";}else{echo "info";}?>">
                            </div>
                            
                            <!-- Mot de passe  -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Mot de passe <span><?php echo $mdp1Err; ?></span></p> <input type="password" name="mdp1" value="<?php if($mdp1Err != ""){echo $_POST['mdp1'];}else{echo "";} ?>" class="bg-light bg-gradient border border-1 rounded border-<?php if($mdp1Err != ""){echo "danger";}else{echo "info";} ?>">
                            </div>
                            
                            <!-- Confirmation Mot de passe  -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Confirmation mot de passe <span><?php echo $mdp2Err; ?></span></p> <input type="password" name="mdp2" value="<?php if($mdp2Err != ""){echo $_POST['mdp2'];}else{echo "";} ?>" class="bg-light bg-gradient border border-1 rounded border-<?php if($mdp2Err != ""){echo "danger";}else{echo "info";} ?>">
                            </div>
                            
                            <!-- Courriel  -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Courriel <span><?php echo $courrielErr; ?></span></p> <input type="courriel" name="courriel" placeholder="Ex. moncourriel@desnations.qc.ca" value="<?php if($courrielErr != ""){echo $_POST['courriel'];}else{echo "";} ?>" class="bg-light bg-gradient border border-1 rounded border-<?php if($courrielErr != ""){echo "danger";}else{echo "info";} ?>">
                            </div>
                            
                            <!-- Avatar  -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Lien vers avatar <span><?php echo $lienErr; ?></span></p> <input type="text" name="lienAvatar" placeholder="lien URL" value="<?php if($lienErr != ""){echo $_POST['lienAvatar'];}else{echo "";} ?>" class="bg-light bg-gradient border border-1 rounded border-<?php if($lienErr != ""){echo "danger";}else{echo "info";} ?>">
                            </div>

                            <!-- Radio bouton pour le sexe -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Sexe <span><?php echo $btnSErr; ?></span></p>
                                <div class="inputs d-flex justify-content-around bg-light bg-gradient border rounded border-1 border-<?php if($btnSErr != ""){echo "danger";}else{echo "info";}?>">
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input border border-1 border-info" type="radio" name="btnS" id="Homme" value="Homme">
                                            <label class="form-check-label" for="btnS">Homme</label>
                                    </div>
                                
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input border border-1 border-info" type="radio" name="btnS" id="Femme" value="Femme">
                                            <label class="form-check-label" for="btnS">Femme</label>
                                    </div>
    
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input border border-1 border-info" type="radio" name="btnS" id="NonGenre" value="Non Genré">
                                            <label class="form-check-label" for="btnS">Non Genré</label>
                                    </div>
                                </div>

                            </div>

                            <!-- date de naissance -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Date de naissance <span><?php echo $dateNaissErr; ?></span></p> <input type="date" name="dateNaiss" value="<?php if($dateNaissErr != ""){echo $_POST['dateNaiss'];}else{echo "";} ?>" class="bg-light bg-gradient border border-1 rounded border-<?php if($dateNaissErr != ""){echo "danger";}else{echo "info";} ?>">
                            </div>

                            <!-- Moyen de transport -->
                            <div class="row px-1 py-2 mx-1">
                                <p class="m-0 p-0 fw-bold">Moyen de transport : <span><?php if($moyTpErr != ""){echo $moyTpErr;}; ?></span></p>
                                <select name="moyTp" class="form-select bg-light bg-gradient border border-1 rounded border-<?php if($moyTpErr != ""){echo "danger";}else{echo "info";} ?>">
                                    <option selected value="nonValide">Choisir son moyen de transport</option>
                                    <option value="Automobile">Automobile</option>
                                    <option value="Autobus">Autobus</option>
                                    <option value="Marche">Marche</option>
                                    <option value="Vélo">Vélo</option>
                                </select>
                            </div>
                            
                                <!-- Bouton pour confirmer -->
                                <div class="row px-1 py-2 mx-1">
                                    <input type="submit" class="card-footer border border-1 border-info bg-info bg-gradient bg-opacity-50 fw-bold">
                                </div>     
                        </form>
                    </div>

                </div>            
            </div>
            <div class="offset col-xl-4"></div>
        </div>
    </div>


    <!-- La carte pour faire afficher les infos du formulaire -->
    <div class="container-fluid" style="display:<?php echo $dispCard; ?>" id="profil">
        <div class="row">
            <div class="offset col-xl-4"></div>
            <div class="col-xl-4 col-4">
                <div class="card border border-1 border-info mb-2 mt-3">

                    <!-- Haut de la carte avec le lien avatar -->
                    <div class="card-header bg-info bg-gradient bg-opacity-50">
                            <img src="<?php echo $lien ?>" id="imgProfil "alt="Avatar" class="w-25 mx-auto d-block rounded-circle border border-3 border-light">
                    </div>

                    <!-- infos du formulaire -->
                    <div class="card-body card-border bg-info bg-gradient bg-opacity-10">
                        <!-- nom usager -->
                        <div class="row border-bottom border-info">
                            <div class="d-flex flex-row align-center pt-1 pb-2">
                                <p class="col-xl-6 m-0 fw-bold text-nowrap">Nom d'usager</p>
                                <p class="col-xl-6 m-0 fw-medium text-nowrap"><?php echo $nom; ?></p>
                            </div>
                        </div>    

                            <!-- courriel -->
                            <div class="row border-bottom border-info">
                                <div class="d-flex flex-row align-center pt-2 pb-1">
                                    <p class="col-xl-6 m-0 fw-bold text-nowrap">Courriel</p>
                                    <p class="col-xl-6 m-0 fw-medium text-nowrap"><?php echo $courriel; ?></p>
                                </div>
                            </div>
                            
                            <!-- sexe -->
                            <div class="row border-bottom border-info">
                                <div class="d-flex flex-row align-center pt-2 pb-1">
                                    <p class="col-xl-6 m-0 fw-bold text-nowrap">Sexe</p>
                                    <p class="col-xl-6 m-0 fw-medium text-nowrap"><?php echo $btnS; ?></p>
                                </div>
                            </div>

                            <!-- Date de naissance -->
                            <div class="row border-bottom border-info">
                                <div class="d-flex flex-row align-center pt-2 pb-1">
                                    <p class="col-xl-6 m-0 fw-bold text-nowrap">Date de naissance</p>
                                    <p class="col-xl-6 m-0 fw-medium text-nowrap"><?php echo $dateNaiss; ?></p>
                                </div>
                            </div>

                            <!-- moyen de transport -->
                            <div class="row">
                                <div class="d-flex flex-row align-center pt-2">
                                    <p class="col-xl-6 m-0 fw-bold text-nowrap">Moyen transport</p>
                                    <p class="col-xl-6 m-0 fw-medium text-nowrap"><?php echo $moyTp; ?></p>
                                </div>
                            </div>
   
                        </div>            
                    </div>        
                </div>
                <div class="offset col-xl-4"></div>
            </div>
                <!-- bouton de creation -->
                <div class="row mt-2">
                    <div class="offset col-xl-4"></div>
                    <div class="col-xl-4">
                        <form action="index.php" method="get">
                            <div class="card">
                                <input type="submit" value="Créer un nouvel usager" class="card-footer rounded border border-1 border-info bg-info bg-gradient bg-opacity-50 fw-bold">
                            </div>
                        </form>
                    </div>
            <div class="offset col-xl-4"></div>
        </div>
    </div>

    <!-- Pour securiser le POST -->
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