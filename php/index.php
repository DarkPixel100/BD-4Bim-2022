<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <h3>Tabela importada do banco com PHP:</h3>
        <?php
        $db = new SQLite3("../db/hsucesso.db");
        $db->exec("PRAGMA foreign_keys = ON");
        $results = $db->query("SELECT * FROM Teste");
        echo '
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
            </tr>
        ';
        while ($row = $results->fetchArray()) {
            echo '
            <tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["nome"] . '</td>
                <td>' . $row["cpf"] . '</td>
            </tr>
            ';
        }
        echo '</table>';
        $db->close();
        ?>
    </div>
</body>

</html>
