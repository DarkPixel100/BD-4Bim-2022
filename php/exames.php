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
        $tabexames = $db->query("SELECT * FROM Exames");
            while ($row = $tabexames->fetchArray()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "<td>";
                echo "</td>";
                echo "</tr>";
            }
    $db->close();
        ?>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>