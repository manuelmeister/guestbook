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
    <a href="index.php" id="logo"><h1>Guestbook</h1></a>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="search.php">Suchen</a></li>
            <li><a href="register.php">Registrieren</a></li>
            <li class="right">
                <?php
                if (isset($_SESSION['login'])) {
                    if ($_SESSION["login"]) {
                        echo '
                <form id="login" name="login" method="post" action="">
                    <input type="submit" name="logout" value="Logout">
                </form>
            </li>
            <li class="right">
                <a>' . $username . '</a>
            </li>
                ';
                    }
                } else {
                    echo '
                <form id="login" name="login" method="post" action="">
                    <input type="text" name="username" placeholder="Benutzername">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" name="login" value="Login">
                </form>
            </li>';
                }
                ?>
        </ul>
    </nav>