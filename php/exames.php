<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Exame - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <?php
        $db = new SQLite3("../db/hsucesso.db");
        $db->exec("PRAGMA foreign_keys = ON");
        $results = $db->query("SELECT * FROM Exames");
        echo "
        <table id='tabelaexame'>
            <tr>
                <th>Nome</th>
                <th>Tipo de Coleta</th>
                <th>Preço</th>
            </tr>
        ";
        while ($row = $results->fetchArray()) {
            echo "<tr>";
            for ($i = 1; $i < sizeof($row) - 4; $i++) { //O -4 é temporário (fetchArray() duplica os valores do query())
                echo "<td>" . $row[$i] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        $db->close();
        ?>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>