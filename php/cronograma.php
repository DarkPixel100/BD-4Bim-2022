<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper" style="justify-content: start;">
        <?php
        if (!isset($_SESSION["startTime"])) header("Location: ./login.php?r=Cronograma");
        ?>
        <h2>Cronograma:</h2>
        <?php
        $db = new SQLite3('../db/userData.db');
        if (!empty($_POST)) {
            $db->exec('DELETE FROM Agendamento WHERE id = ' . $_POST["examId"] . ';');
        }
        $results = $db->query('SELECT Agendamento.id, DadosExames.nome, Agendamento.horario, Users.nomeReal FROM Agendamento JOIN Users ON Users.id = ' . $_SESSION["currentUserID"] . ' AND Users.id = Agendamento.paciente_id JOIN DadosExames ON DadosExames.id = Agendamento.exame_id;');
        $row = $results->fetchArray(SQLITE3_NUM);
        if (is_array($row) && sizeof($row) > 0) {
            echo '
            <table id="tabelaexame">
                <thead>
                    <tr>
                        <th>Exame:</th>
                        <th>Data/Horário:</th>
                        <th>Paciente:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><p>' . $row[1] . '</p></td>
                        <td><p>' . $row[2] . '</p></td>
                        <td><p>' . $row[3] . '</p></td>
                        <td>
                            <form action="" method="post">
                                <button type="submit">Desmarcar</button>
                                <input hidden name="examId" value="' . $row[0] . '">
                            </form>
                        </td>
                    </tr>
            ';
            while ($row = $results->fetchArray(SQLITE3_NUM)) {
                echo '<tr id="' . $row[0] . '">';
                $row[2] = date('d/m/Y / H:i', strtotime($row[2]));
                for ($i = 1; $i < sizeof($row); $i++) {
                    echo '<td><p>' . $row[$i] . '</p></td>';
                }
                echo '
                <td>
                    <form action="" method="post">
                        <button type="submit">Desmarcar</button>
                        <input hidden name="examId" value="' . $row[0] . '">
                    </form>
                </td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
            unset($row);
        } else {
            echo '<p>Sem agendamentos feitos.</p>';
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