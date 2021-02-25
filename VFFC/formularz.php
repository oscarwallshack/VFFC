<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
    <link rel="stylesheet" href="CSS/formularz.css" type="text/css">
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

    <div id="mainConatainer">

        <div class="formContainer">
            <form class="form" action="walidacja.php" method="post">
                <!--przekierowanie do pliku walidacja.php, dane przesyłane metodą POST  następnie do udaneZamowienie po pomyślnej walidacji-->
                <table>
                    <caption>Formularz zamówienia.</caption>
                    <tr>
                        <td colspan="2"><b>Imię:</b>
                            <input type="text" id="imie" name="imie" pattern="[A-Za-ząćęłńóśźż]{2,}" value="<?= isset($_SESSION['takenImie']) ? $_SESSION['takenImie'] : "" ?>">
                            <?php
                            if (isset($_SESSION['e_imie'])) {
                                echo '<p class="error">' . $_SESSION['e_imie'] . '<p>';
                                unset($_SESSION['e_imie']);
                            }

                            ?>
                        </td>


                    </tr>
                    <tr>
                        <td colspan="2"><b>Nazwisko:</b>
                            <input id="nazwisko" name="nazwisko" pattern="[A-Za-z]{2,}" required value="<?= isset($_SESSION['takenNazwisko']) ? $_SESSION['takenNazwisko'] : "" ?>">
                        </td>
                    </tr>
                    <?php
                    if (isset($_SESSION['e_nazwisko'])) {
                        echo '<p class="error">' . $_SESSION['e_nazwisko'] . '<p>';
                        unset($_SESSION['e_nazwisko']);
                    }
                    ?>
                    <tr>
                        <td colspan="2"><b>Adres email:</b>
                            <input id="email" name="email" type="text" value="<?= isset($_SESSION['takenEmail']) ? $_SESSION['takenEmail'] : "" ?>">
                            <?php
                            if (isset($_SESSION['e_email'])) {
                                echo '<p class="error">' . $_SESSION['e_email'] . '<p>';
                                unset($_SESSION['e_email']);
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <?php
                        $data = date("Y-m-d");
                        $termin = date("Y-m-d", strtotime("$data + 7 day")); //najbliży możliwy termin (za tydzień)
                        ?>
                        <td colspan=" 2"><b>Jaka przybliżona data sesji Cie interesuje?</b>

                            <input id="data" type="date" name="dataSesji" value="<?= isset($_SESSION['takenDataSesji']) ? $_SESSION['takenDataSesji'] : $termin ?>" required>
                            <?php
                            if (isset($_SESSION['e_dataSesji'])) {
                                echo '<p class="error">' . $_SESSION['e_dataSesji'] . '<p>';
                                unset($_SESSION['e_dataSesji']);
                            }
                            ?>
                        </td>
                    </tr>



                    <tr>
                        <td colspan="2">
                            <p><b>Wybierz auta na sesję.</b></p>
                            <label><input type="checkbox" name="jakieAuto[]" value="Ferrari">Ferrari</label>
                            <label><input type="checkbox" name="jakieAuto[]" value="Lamborghini">Lamborghini</label>
                            <label><input type="checkbox" name="jakieAuto[]" value="Porshe">Porshe</label>
                            <?php
                            if (isset($_SESSION['e_jakieAuto'])) {
                                echo '<p class="error">' . $_SESSION['e_jakieAuto'] . '<p>';
                                unset($_SESSION['e_jakieAuto']);
                            }
                            ?>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="infoTd"><b>Gdzie chcesz aby odbyła się sesja?</b></p>
                            <label><input type="checkbox" name="miejsce[]" value="Las">Las</label>
                            <label><input type="checkbox" name="miejsce[]" value="Lotnisko">Lotnisko</label>
                            <label><input type="checkbox" name="miejsce[]" value="Stare miasto">Stare miasto</label>
                            <?php
                            if (isset($_SESSION['e_miejsce'])) {
                                echo '<p class="error">' . $_SESSION['e_miejsce'] . '<p>';
                                unset($_SESSION['e_miejsce']);
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <p><b>Pakiet sprzętowy</b></p>
                            <label><input type="radio" name="pakiet" value="niskobudzetowy">Niskobudżetowy 1000zł</label><br>
                            <label><input type="radio" name="pakiet" value="podstawowy">Podstawowy 1600zł</label><br>
                            <label><input type="radio" name="pakiet" value="premium">Premium 2800zł</label>
                            <?php
                            if (isset($_SESSION['e_pakiet'])) {
                                echo '<p class="error">' . $_SESSION['e_pakiet'] . '<p>';
                                unset($_SESSION['e_pakiet']);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p><b>Sprecyzuj nam swoją wizję, a my postaramy się spełnić Twoje potrzeby.</b></p>
                            <textarea name="komentarz" cols="50" rows="10"><?= isset($_SESSION['takenKomentarz']) ? $_SESSION['takenKomentarz'] : "" ?></textarea>
                            <?php
                            if (isset($_SESSION['e_komentarz'])) {
                                echo '<p class="error">' . $_SESSION['e_komentarz'] . '<p>';
                                unset($_SESSION['e_komentarz']);
                            }
                            ?>

                        </td>
                    </tr>
                    <br><br>
                    <tr>
                        <td colspan="2">
                            <input class="button" name="submit" type="submit" value="Wyślij formularz">
                            <input class="button" type="reset" value="Wyczyść dane">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
   

    </div>



</body>

<section class="social-menu colorform" id="manu2">
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