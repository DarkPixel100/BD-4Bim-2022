<?php
$username = $_POST["name"];
$password = $_POST["senha"];
// session_start();
// $id = session_id();
// echo $id;
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
if(!$_SESSION) {
    $output = "Error";
}
return $output;
header("Location: index.php?" . $output);