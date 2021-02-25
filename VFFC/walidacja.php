<?php

session_start();

// ustawienie flagi 

$wszystko_ok = true;

$illegal = "#$%^&*+=-[]';/{}|:<>~"; //deklaracja znaków zakazanych w formularzu 

//zapisanie podanych wartości aby nie trzeba było ich wpisywać ponownie w formularzu
$_SESSION['takenImie'] = $_POST['imie'];
$_SESSION['takenNazwisko'] = $_POST['nazwisko'];
$_SESSION['takenEmail'] = $_POST['email'];
$_SESSION['takenDataSesji'] = $_POST['dataSesji'];
//$_SESSION['takenJakieAuto'] = $_POST['jakieAuto']; ################################# SPROBOWAC ZROBIC
//$_SESSION['takenMiejsce'] = $_POST['miejsce']; 
//$_SESSION['takenPakiet'] = $_POST['pakiet']; 
$_SESSION['takenKomentarz'] = $_POST['komentarz'];



// ### walidacja imie ###
$imie = $_POST['imie'];

if (empty($imie) || strpbrk($imie, $illegal)) { //sprawdzenie czy istnieje zmienna imie, czyskłada się tylko z liter 
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_imie'] = "Pole wymagane, może zawierać tylko duże i małe litery."; //tresc błedu
    header('Location: formularz.php'); //przeniesienie spowrtotem do formularza
    exit(); //przerwanie dalszej realizacji kodu 
}

// ### walidacja nazwiska ###
$nazwisko = $_POST['nazwisko']; //pobranie danych z tablicy POST

if (empty($nazwisko) || strpbrk($nazwisko, $illegal)) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_nazwisko'] = "Pole wymagane, może zawierać tylko duże i małe litery."; //tresc błedu
    header('Location: formularz.php'); //przeniesienie spowrtotem do formularza
    exit(); //przerwanie dalszej realizacji kodu 
}

// ### walidacja email ###
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //sprawdzenie formy emaila podanego przez uzytkownika 

if (empty($email)) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_email'] = "Niepoprawny format email.";
    header('Location: formularz.php');
    exit();
}

// ### walidacja daty ###
$obecnie = date("Y-m-d");
$termin = date("Y-m-d", strtotime("$obecnie + 7 day"));
$dataSesji = $_POST['dataSesji'];
if (empty($dataSesji)) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_dataSesji'] = "Proszę podać datę jaka Państwa interesuje.";
    header('Location: formularz.php');
    exit();
}
if ($dataSesji < $termin) { //sprawdzenie czy termin wypada conajmniej 7 dni do przodu
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_dataSesji'] = "Możliwie najszybszy termin ralizacji zlecenia to 7 dni.";
    header('Location: formularz.php');
    exit();
}
$timeStamp = strtotime($dataSesji); //zmiana zapisu na yyyy-mm-dd
$dataSesji = date("Y-m-d, $timeStamp");

// ### walidacja opcji ###

//checkbox1

if (!isset($_POST['jakieAuto'])) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_jakieAuto'] = "Pole wymagane!";
    header('Location: formularz.php');
    exit();
} else {
    $checkbox1 = $_POST['jakieAuto'];
    $jakieAuto = "";
    foreach ($checkbox1 as $key) {
        $jakieAuto .= $key . ", ";
    }
}

//checkbox2

if (!isset($_POST['miejsce'])) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_miejsce'] = "Pole wymagane!";
    header('Location: formularz.php');
    exit();
} else {
    $checkbox2 = $_POST['miejsce'];
    $miejsce = "";
    foreach ($checkbox2 as $key) {
        $miejsce .= $key . ", ";
    }
}

//radio
$pakiet = $_POST['pakiet'];
if (!isset($pakiet)) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_pakiet'] = "Pole wymagane!";
    header('Location: formularz.php');
    exit();
}


// ### walidacja komentarza ###

$komentarz = $_POST['komentarz'];
if (empty($komentarz)) {
    $wszystko_ok = false; //zmiana wartości flagi 
    $_SESSION['e_komentarz'] = "Pomóż nam przygotować ofertę która będzie idealna dla Ciebie! ;)";
    header('Location: formularz.php');
    exit();
} else {
    if (strpbrk($komentarz, $illegal)) {
        $wszystko_ok = false; //zmiana wartości flagi 
        $_SESSION['e_komentarz'] = "Pole może zawierać tylko litery i cyfry.";
        header('Location: formularz.php');
        exit();
    }
}

// ### czy walidacja się powiodła ###
if ($wszystko_ok == true) {

    try {

        require_once 'base_connection/database.php';

        // sprawdzenie czy podany email został już wykorzystany 

        $rezultat = $db->prepare("SELECT id FROM vffc.klienci WHERE email = ? ");
        $rezultat->execute(array($email));

        if (!$rezultat) throw new Exception($db->error);

        $rezultat = $rezultat->rowCount();
        if ($rezultat > 0) {
            $_SESSION['e_email'] = "Zamówienie zostało, już złożnone, proszę czekać na kontakt.";
            header('Location: formularz.php');
            exit();
        }

        //dodanie danych do bazy

        $query = $db->prepare("INSERT INTO vffc.klienci VALUES (NULL, :imie, :nazwisko, :email, :dataSesji, :jakieAuto, :miejsce, :pakiet, :komentarz)");
        $query->bindValue(':imie', $imie, PDO::PARAM_STR);
        $query->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':dataSesji', $dataSesji, PDO::PARAM_STR);
        $query->bindValue(':jakieAuto', $jakieAuto, PDO::PARAM_STR);
        $query->bindValue(':miejsce', $miejsce, PDO::PARAM_STR);
        $query->bindValue(':pakiet', $pakiet, PDO::PARAM_STR);
        $query->bindValue(':komentarz', $komentarz, PDO::PARAM_STR);

        $query->execute();
        $_SESSION['udaneZamowienie'] = true;

        header('Location: udaneZamowienie.php');
        exit();
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o złożenie zamówienia w innym terminie!</span>';
        echo '<br><b>Informacja developerska: </b>' . $e;
    }
}
