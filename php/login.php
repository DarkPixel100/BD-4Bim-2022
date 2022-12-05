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
        $username = $_POST["user"];
        $password = $_POST["senha"];
        $db = new SQLite3("../db/hsucesso.db");
        $db->exec("PRAGMA foreign_keys = ON");
        $userResults = $db->query("SELECT * FROM UserData");
        while ($row = $userResults->fetchArray()) {
            if ($row["username"] == $username && $row["password"] == $password) {
                echo "aaa";
                session_start(
                    ["cookie_lifetime" => 600000]
                );
                $_SESSION["currentUserID"] = $row["id"];
                if (isset($_POST["location"])) {
                    header("Location: " . $_POST["location"]);
                } else {
                    header("Location: ./index.php");
                }
                break;
            }
        }
        /*if (!isset($_SESSION)) {
            $output = "Error";
          }*/
        ?>
        <form id="loginContainer" method="POST" action="">
            <label for="user"><b>Usuário:</b></label>
            <input type="text" placeholder="Digite o usuário" name="user" required>

            <label for="senha"><b>Senha:</b></label>
            <input type="password" placeholder="Digite a senha" name="senha" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Lembre-me</input>
            </label>
        </form>
    </div>
    <?php include './footer_inc.php'; ?>
</body>

</html>