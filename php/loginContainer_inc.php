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

<?php
$username = $_POST["name"];
$password = $_POST["senha"];
$db = new SQLite3("../db/hsucesso.db");
$db->exec("PRAGMA foreign_keys = ON");
$results = $db->query("SELECT * FROM UserData");
while ($row = $results->fetchArray()) {
    if ($row["username"] == $username && $row["password"] == $password) {
        session_start(
            ["cookie_lifetime" => 600000]
        );
        $_SESSION["currentUserID"] = $row["id"];
        $output = "Succesful";
        break;
    }
}
if (!$_SESSION) {
    $output = "Error";
}
return $output;
header("Location: index.php?" . $output);
echo "a" . $_POST["name"];
?>