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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
    <link rel="stylesheet" href="CSS/zarzadzanie.css" type="text/css">
    <link rel="stylesheet" href="CSS/todo.css" type="text/css">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap&subset=latin-ext" rel="stylesheet">

    <script src="js/todo.js" defer></script>
    <!--defer - skrypt js nie wykona się dopóki strona się nie załaduje -->

    <title>V F F C .</title>
</head>

<header>
    <h2 class="resp">Professional fotoshooting and editing.</h2>
    <div class="resp" id="logo">V F F C .</div>

    <nav class="resp">
        <a href="todo.php">Lista do zrobienia</a>
        <a href="zarzadzanie.php">Zarządzanie</a>
        <a href="logout.php">Wyloguj</a>
    </nav>
</header>

<body>
    <div id="todoContainer">
        <h1 id="date">Dzisiejsza data: </h1>
        <h2>Lista rzeczy do odhaczenia:</h2>

        <form id="form">

            <input type="text" class="input" id="input" placeholder="Twoje zadanie." autocomplete="off"/>
            
            <ul id="todos" class="todos"></ul>

        </form>

        <small>Lewy przycisk myszy odznacza zadania <br /> Prawy przycisk myszy usówa zadania.</small>
    </div>

    <footer class="resp">
        &copy;oscarwallshack.
    </footer>
</body>

</html>