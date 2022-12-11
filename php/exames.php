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
    <link rel="stylesheet" href="../css/exames.css">
    <script src="../js/dropdown.js"></script>
    <script src="../js/exames.js"></script>
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <h2>Tipos de Exame:</h2>
        <?php
        $db = new SQLite3('../db/userData.db');
        $results = $db->query('SELECT * FROM DadosExames;');
        echo '
        <table id="tabelaexame">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo de Coleta</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
        ';
        while ($row = $results->fetchArray(SQLITE3_NUM)) {
            echo '<tr id="' . $row[0] . '">';
            for ($i = 1; $i < sizeof($row) - 1; $i++) {
                echo '<td>';
                if ($i == 1) {
                    echo '<div><p class="nome">' . $row[$i] . '</p><p class="descricao">' . $row[sizeof($row) - 1] . '</p></div></td>';
                } else {
                    echo '<p>' . $row[$i] . '</p>';
                }
            }
            echo '</tr>';
        }
        unset($row);
        echo '</tbody></table>';
        $db->close();
        ?>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>