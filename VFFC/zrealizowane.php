<?php

session_start();

// sprawdzenie czy został wpisany adres email

if (!isset($_POST['usun_email']) || $_POST['usun_email'] == "") {
    $_SESSION['err_email'] = '<span style="color:red"> Nie wpisano adresu email. </span>';
    header('Location: zarzadzanie.php');
    exit();
}

// walidacja dostarczanego emaila nie jest potrzebna ponieważ przychodzi od admina. Walidator HTML wystarcza w kwestii poprawności składni

//sprawdzenie czy podany email znajduje się w bazie, jesli tak to odznaczamy jako zrealizowany i usuwamy, 

require_once 'base_connection/database.php';

$email = $_POST['usun_email']; //zapisanie usuwanego emaila do zmiennej $email

$query = $db->prepare("SELECT * FROM vffc.klienci WHERE email = ?");
$query->execute(array($email));

$ile_zlecen = $query->rowCount(); //sprawdzenie czy email istnieje w bazie

if ($ile_zlecen > 0) {

    $usun = $db->prepare("DELETE FROM vffc.klienci WHERE email='$email'"); //polecenie usunięcia wpisu
    $usun->execute();

    $spr = $usun->rowCount();

    //sprawdzenie czy udało się usunąć rekord

    if ($spr > 0) {
        $_SESSION['wynik_operacji'] = "Usunięto rekord";
        header('Location: zarzadzanie.php');
        exit();
    } else {
        $_SESSION['wynik_operacji'] = "Coś poszło nie tak";
        header('Location: zarzadzanie.php');
        exit();
    }
} else {
    $_SESSION['err_email'] = '<span style="color:red"> Podanego adresu email nie ma w bazie. </span>';
    header('Location: zarzadzanie.php');
    exit();
}
