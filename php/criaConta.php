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
        if (!empty($_POST)) {
            if ($_POST["senha"] == $_POST["senha2"]) {

                $username = $_POST["user"];
                $email = $_POST["email"];
                $password = $_POST["senha"];
                $db = new SQLite3("../db/hsucesso.db");
                $db->exec("PRAGMA foreign_keys = ON");
                $db->exec("INSERT INTO UserData (username, email, password) VALUES ('" . $username . "', '" . $email . "', '" . $password . "')");
                header("Location: ./login.php");
            } else {
                echo "<p><b>As senhas não coincidem.</b></p>";
            }
        }
        ?>
        <form id="loginContainer" method="POST" action="">
            <label for="user"><b>Usuário:</b></label>
            <input type="text" placeholder="Nome de usuário" name="user" maxlength="15" required>

            <label for="email"><b>Email:</b></label>
            <input type="text" placeholder="Email" name="email" maxlength="30" required>

            <label for="senha"><b>Senha:</b></label>
            <input type="password" placeholder="Senha" name="senha" maxlength="20" required>

            <label for="senha2"><b>Repita a senha:</b></label>
            <input type="password" placeholder="Repita a senha" name="senha2" maxlength="20" required>

            <button type="submit">Criar Conta</button>
            <br>
            <a href="./login.php">Já tenho uma conta</a>
        </form>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>
