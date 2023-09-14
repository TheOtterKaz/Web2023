<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Supprimer</title>
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

// lecture des données
        $sql = "DELETE FROM doggo2 WHERE id = " . $_GET["id"];

// Verification avant suppression
        if(mysqli_query($conn, $sql))
            {
                $erreur = false;
                $result = "<strong>Le chien a été supprimé<strong>";
            }
        else
            {
                $erreur = true;
                $result = "<strong>Erreur<strong>" . $sql . "<br>" . mysqli_error($conn);
            }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="offset col-xl-4"></div>
            <div class="col-xl-4">
                <div class="alert alert-<?php if($erreur == false){echo "success";}else{echo "danger";}?> text-center rounded-pill mt-5">
                    <p class="mt-3 text-center"><?php echo $result; ?></p>
                    <p class="text-center">Vous serez redirigé dans <span id="nbSec" class="fw-bold"></span> secondes</p>

                    <script>
                        var sec = 5;
                        var timer = setInterval(function()
                            {
                                document.getElementById('nbSec').innerHTML = sec;
                                sec--;
                                if (sec < 0)
                                    {
                                        clearInterval(timer);
                                        window.location = "index.php";
                                    }
                            }, 1000);
                    </script>            
                </div>
            </div>
            <div class="offset col-xl-4"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>