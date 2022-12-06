<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <?php
        if (isset($_GET["r"])) {
            echo "<p><b>Faça login para poder acessar a página \"" . $_GET["r"] . "\".</b></p>";
        }
        if (!empty($_POST)) {
            $user_email = $_POST["userORemail"];
            $password = $_POST["senha"];
            $db = new SQLite3("../db/hsucesso.db");
            $db->exec("PRAGMA foreign_keys = ON");
            $userResults = $db->query("SELECT * FROM UserData");
            while ($row = $userResults->fetchArray()) {
                if (($row["username"] == $user_email || $row["email"] == $user_email) && $row["password"] == $password) {
                    if (!isset($_POST["remember"])) {
                        $_SESSION["lifeTime"] = 600;
                    }
                    session_start();
                    $_SESSION["loggedIn"] = "loggedIn";
                    $_SESSION["startTime"] = time();
                    $_SESSION["currentUserID"] = $row["id"];
                    $_SESSION["currentUserName"] = $row["username"];
                    if (isset($_GET["r"])) {
                        header("Location: " . $_GET["r"] . ".php");
                    } else {
                        header("Location: ./index.php");
                    }
                    break;
                }
            }
            if (!isset($_SESSION["loggedIn"])) {
                echo "<p><b>Usuário/Email e/ou Senha incorretos.</b></p>";
            }
        }
        ?>
        <form id="loginContainer" method="POST" action="">
            <label for="userORemail"><b>Usuário / Email:</b></label>
            <input type="text" placeholder="Digite o usuário/email" name="userORemail" maxlength="30" required>

            <label for="senha"><b>Senha:</b></label>
            <input type="password" placeholder="Senha" name="senha" maxlength="20" required>

            <input type="checkbox" name="remember"> <b>Lembre-me</b></input>
            <br>
            <button type="submit">Login</button>
            <br>
            <a href="./criaConta.php">Ainda não tenho uma conta</a>
        </form>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>
