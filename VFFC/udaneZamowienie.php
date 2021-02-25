<?php
session_start();

if (!isset($_SESSION['udaneZamowienie'])) {
    header('Location: formularz.php');
    exit();
} else {
    unset($_SESSION['udaneZamowienie'] );
    unset($_SESSION['takenImie'] );
    unset($_SESSION['takenNazwisko'] );
    unset($_SESSION['takenEmail'] );
    unset($_SESSION['takenDataSesji'] );
    unset($_SESSION['takenKomentarz'] );

    
}
?>

<!DOCTYPE html>
<html lang="pl">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" href="CSS/style.css" type="text/css">
        <link rel="stylesheet" href="CSS/tabela.css" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap&subset=latin-ext" rel="stylesheet">
        <title>V F F C .</title>
    </head>

    <body>

        <header>
        <h2 class="resp">Professional fotoshooting and editing.</h2>

            <div class="resp" id="logo">V F F C .</div>

            <nav class="resp">
                <a href="index.php">Start</a>
                <a href="galeria.php">Galeria</a>
                <a href="formularz.php">Współpraca</a>
                <a href="kontakt.php">Kontakt</a>
                <a href="about.php">O nas</a>
                <a href="logowanie.php">Zaloguj</a>

            </nav>
        </header>

        <section>

            <h1>UDAŁO SIĘ ZŁOŻYC ZAMOWIENIE</h1>
            Odezwiemy się do Państwa możliwie najszybciej po przygotowaniu oferty.
        </section>

        <section class="social-menu" id="manu2">
            <ul>
                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                <li><a href=""><i class="fa fa-instagram"></i></a></li>
                <li><a href=""><i class="fa fa-youtube"></i></a></li>
            </ul>
        </section>

        <footer class="resp">
            &copy;oscarwallshack.
        </footer>
    </body>
</html>