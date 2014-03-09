<!DOCTYPE html>
<html lang="de-CH">
<head>
    <title>Testsite</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <meta charset="UTF-8">
</head>
<body>
<div id="container">
    <header>
        <a href="index.php" id="logo"><h1>Guestbook</h1></a>

        <div class="wrapper">
            <?php
            if (isset($_SESSION['login'])) {
                if ($_SESSION["login"]) {
                    echo '
                <form id="login" name="login" method="post" action="">
                <a>' . $username . '</a>
                    <input type="submit" name="logout" value="Logout">
                </form>
                ';
                } else {
                    echo '<form id="login" name="login" method="post" action="">
                <input class="login_field" type="text" name="username" placeholder="Benutzername">
                <input class="login_field" type="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Login">
            </form>';
                }
            } else {
                echo '<form id="login" name="login" method="post" action="">
                <input class="login_field" type="text" name="username" placeholder="Benutzername">
                <input class="login_field" type="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Login">
            </form>';
            }
            ?>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Registrieren</a></li>
            <li class="right">
                <form action="search.php" method="get" class="search">
                    <input type="search" name="val" placeholder="Suchbegrif"/>
                    <input type="submit" name="search" value="Suchen"/>
                </form>
            </li>
        </ul>
    </nav>