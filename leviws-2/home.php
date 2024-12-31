<?php

// Inizio della sessione
session_start();

// Dichiarazione della variabile globale $pdo, necessaria per i file db.php e functions.php
global $pdo;

// Verificare che l'utente (admin o user) si sia prima loggato
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'includes/db.php'; // Richiedere il file includes/db.php
require 'includes/functions.php'; // Richiedere il file includes/functions.php

// Verificare che l'utente sia admin o user
$userGroupId = $_SESSION['group_id'];

// Assegnare i permessi che spettano a quella categoria di utente (admin o user)
$canAccessSettings = checkPermission($pdo, $userGroupId, 'access_settings');
?>
<!DOCTYPE html>
<html lang = "it">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "assets/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "assets/css/leviws-2Stile.css">
    <style>
        .boxSaluto {
            position: absolute;
            bottom: 77%;
            width: 100%;
            height: 8%;
            background: rgba(0, 0, 0, 0.6)
        }
        .boxLoghi {
            position: absolute;
            bottom: 17.5%;
            width: 100%;
            height: 33.48%;
            background: rgba(0, 0, 0, 0.6)
        }
    </style>
    <script src = "assets/js/jquery-3.7.1.js"></script>
    <script src = "assets/js/bootstrap.bundle.min.js"></script>
    <script src = "assets/js/leviws-2Script.js"></script>
    <script type = "text/javascript">

        // Chiamata della funzione di gestione dell'effetto di traslazione
        $(document).ready(traslazioneFine)

        // Funzione finalizzata ad implementare l'effetto di intermittenza nei widget h1
        function traslazioneFine() {
            $("h1").delay(1000).animate({opacity: 1}).delay(500).animate({opacity: 0.25}).delay(250).animate({opacity: 1});
        }
    </script>
    <title>Home</title>
</head>
<body>
<div class = "navbar navbar-expand-lg navbar-dark bg-dark">
    <div class = "container">
        <a class = "navbar-brand" href = "#" target = "_blank">IIS Primo Levi in <img src = "images/logo.gif" alt = "Logo">!</a>
        <div class = "collapse navbar-collapse">
            <ul class = "navbar-nav ms-auto">
                <li class = "nav-item"><a href = "home.php" target = "_blank" class = "nav-link">Home</a></li>
                <li class = "nav-item"><a href = "#" target = "_blank" class = "nav-link">Invia proposta</a></li>
                <li class = "nav-item"><a href = "#" target = "_blank" class = "nav-link">Compila modulo</a></li>
                <li class = "nav-item"><a href = "#" target = "_blank" class = "nav-link">Stampa modulo</a></li>
                <?php if ($canAccessSettings): ?>
                    <li class = "nav-item"><a href = "manage_users.php" target = "_blank" class = "nav-link">Gestione utenti</a></li>
                <?php endif; ?>
                <li class = "nav-item"><a href = "#" target = "_blank" class = "nav-link">Gestione proposte</a></li>
                <li class = "nav-item"><a href = "#" target = "_blank" class = "nav-link">Compila relazione</a></li>
                <li class = "nav-item"><a href = "#" target = "_blank" class = "nav-link">Contatti</a></li>
                <li class = "nav-item"><a href = "logout.php" target = "_blank" class = "nav-link">Log out</a></li>
            </ul>
        </div>
    </div>
</div>
<div class = "container">
    <div class = "boxSfondo">
        <img src = "images/sfondo.jpg" class = "trasparenza img-fluid" alt = "IIS Primo Levi"/>
        <div class = "boxSaluto">
            <!--<h1 style = "opacity: 0" class = "text-start text-light">Salve giuseppeGrandi!!!</h1>-->
            <?php

            // Salvare il nome dell'utente che si è loggato
            $username = $_POST['username'];

            // Salutare l'utente che ha effettuato l'accesso secondo una modalità consona all'orario di login
            if (date("H") > 0 and date("H") < 12)
                echo "<h1 style = 'opacity: 0' class = 'text-start text-light'>Buongiorno $username!!!</h1>";
            else
                echo "<h1 style = 'opacity: 0' class = 'text-start text-light'>Buonasera $username!!!</h1>";
            ?>
        </div>
        <div class = "boxLoghi">
            <table>
                <tr>
                    <td><a href = "https://www.istitutolevi.edu.it" target = "_blank" title = "IIS Primo Levi"><img src = "images/logoLevi.png" class = "transizioneInizio img-fluid" alt = "Logo Levi"/></a></td>
                    <td><a href = "https://pnrr.istruzione.it" target = "_blank" title = "Futura"><img src = "images/logoFutura.png" class = "transizioneInizio img-fluid" alt = "Logo Futura"/></a></td>
                    <td><a href = "https://www.comune.vignola.mo.it" target = "_blank" title = "Città di Vignola"><img src = "images/logoVignola.png" class = "transizioneInizio img-fluid" alt = "Logo Vignola"/></a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>