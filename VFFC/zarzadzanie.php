<?php
session_start();

if (!isset($_SESSION['udaneLogowanie'])) {
    header('Location:logowanie.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
    <link rel="stylesheet" href="CSS/zarzadzanie.css" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <title>V F F C .</title>
</head>

<body>

    <header>
        <h2 class="resp">Professional fotoshooting and editing.</h2>
        <div class="resp" id="logo">V F F C .</div>

        <nav class="resp">
            <a href="todo.php">Lista do zrobienia</a>
            <a href="zarzadzanie.php">Zarządzanie</a>
            <a href="logout.php">Wyloguj</a>
        </nav>
    </header>

    <section>

        <?php

        echo "<h3>Witaj " . $_SESSION['login'] . '! Co tam dzisiaj działamy? <br/><br/>';
        try {

            require_once 'base_connection/database.php';

            $sql = 'SELECT * FROM vffc.klienci';
            $wyswietl = $db->query($sql);

            if (!$wyswietl) throw new Exception($db->error);

            $ile_wynikow = $wyswietl->rowCount();
            if ($ile_wynikow > 0) { //sprawdzenie czy zostały zwrócone jakieś rekordy


                echo "Udało się pobrać dane. <br/>";
            } else {
                echo "Brak wyników do wyświetlnia";
            }
        } catch (Exception $e) {
            echo '<span style="color:red;">Błąd serwera!</span>';
            echo '<br />Informacja developerska: ' . $e;
        }

        ?>
        <!--ZARZĄDZANIE BAZĄ -->
        <br><br>
        <form action="zrealizowane.php" method="POST">
            <table class="resp">
                <tr>
                    <td><b class="naglowki">Zrealizowane zlecenia.</b></td>
                </tr>

                <tr>
                    <td>
                        <label>Wpisz email aby wykreślić z bazy zlecenie jako zrealizowane.</label>
                        <input type="email" name="usun_email">
                        <input type="submit" value="Zrealizowany">
                    </td>
                </tr>
                <?php
                if (isset($_SESSION['err_email'])) {
                    echo $_SESSION['err_email'];
                    unset($_SESSION['err_email']);
                }
                if (isset($_SESSION['wynik_operacji'])) {
                    echo $_SESSION['wynik_operacji'];
                    unset($_SESSION['wynik_operacji']);
                }
                ?>
            </table>
        </form>

        <!--WYŚWIETLENIE WYNIKÓW Z BAZY -->
        <br><br>
        <div class="resp">

            <table>
                <thead>
                    <tr class="naglowki">
                        <td id="w1">Imie</td>
                        <td id="w1">Nazwisko</td>
                        <td id="w1">Email</td>
                        <td id="w2">Data Sesji</td>
                        <td id="w1">Auta</td>
                        <td id="w1">Miejsce</td>
                        <td id="w1">Pakiet</td>
                        <td id="w1">Komentarz</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($wyswietl as $data) { //pobranie danych i zapis do zmiennej $data jako tablica asocjacyjna
                    ?>
                        <tr class="border">
                            <td>
                                <?= $data['imie'] ?>
                            </td>
                            <td>
                                <?= $data['nazwisko'] ?>
                            </td>
                            <td>
                                <?= $data['email'] ?>
                            </td>
                            <td id="data">
                                <?= $data['dataSesji'] ?>
                            </td>
                            <td>
                                <?= $data['jakieAuto'] ?>
                            </td>
                            <td>
                                <?= $data['miejsce'] ?>
                            </td>
                            <td>
                                <?= $data['pakiet'] ?>
                            </td>
                            <td>
                                <?= $data['komentarz'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

    </section>
    </div>
    <section class="social-menu " id="manu2">
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