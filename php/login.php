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
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <?php
        if (isset($_GET["r"])) {
            echo '<p><b>Faça login para poder acessar a página "' . $_GET["r"] . '".</b></p>';
        }
        if (!empty($_POST)) {
            $user_email = trim($_POST["userORemail"]);
            $password = md5(trim($_POST["senha"]));
            $db = new SQLite3('../db/userData.db');
            $userResults = $db->query('SELECT * FROM Users WHERE (username = "' . $user_email . '" OR email = "' . $user_email . '") AND password = "' . $password . '";');
            $row = $userResults->fetchArray(SQLITE3_ASSOC);
            if (is_array($row) && sizeof($row) > 0) {
                if (!isset($_POST["remember"])) {
                    $_SESSION["lifeTime"] = 600;
                }
                session_start();
                $_SESSION["loggedIn"] = 'loggedIn';
                $_SESSION["startTime"] = time();
                $_SESSION["currentUserID"] = $row["id"];
                $_SESSION["currentUserName"] = $row["username"];
                $_SESSION["currentUserType"] = $db->querySingle('SELECT * FROM Funcionarios WHERE id = ' . $row["id"] . ';', true)["type"];
                if (isset($_GET["r"])) {
                    header('Location: ' . $_GET["r"] . '.php');
                } else {
                    header('Location: ./home.php');
                }
            }
            unset($row);
            $db->close();
            if (!isset($_SESSION["loggedIn"])) {
                echo '<p><b>Usuário/Email e/ou Senha incorretos.</b></p>';
            }
        }
        ?>
        <h3>Login:</h3>
        <form id="loginContainer" class="boundBox" action="" method="POST">
            <label for="userORemail">Usuário / Email:</label>
            <input type="text" placeholder="Digite o usuário/email" name="userORemail" maxlength="30" required>

            <label for="senha">Senha:</label>
            <input type="password" placeholder="Senha" name="senha" maxlength="20" required>

            <input type="checkbox" name="remember"><b> Lembre-me</b></input>
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