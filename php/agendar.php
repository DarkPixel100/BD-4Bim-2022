<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <h2>Agendar:</h2>
        <?php
        if (!isset($_SESSION["startTime"])) header('Location: ./login.php?r=Agendar');
        if (!empty($_POST)) {
            $db = new SQLite3('../db/userData.db');
            $patientCheck = $db->querySingle('SELECT Users.id FROM Agendamento JOIN Users ON Users.id = ' . $_POST["paciente"] . ' AND (Users.id = Agendamento.paciente_id OR Users.id = Agendamento.enfermeiro_id) AND Agendamento.horario = "' . $_POST["datahorario"] . '";', true);
            $nurseCheck = $db->querySingle('SELECT Funcionarios.id FROM Agendamento LEFT JOIN Funcionarios ON Funcionarios.id = ' . $_POST["enfermeiro"] . ' AND Funcionarios.id = Agendamento.enfermeiro_id AND Agendamento.horario = "' . $_POST["datahorario"] . '" JOIN Users ON Funcionarios.id = Users.id AND Funcionarios.type = "enfermeiro";', true);
            // echo $_POST["paciente"] . '-------' . $_POST["datahorario"] . '-------' . $_POST["enfermeiro"] . '<br>';
            if (is_array($patientCheck) && sizeof($patientCheck) > 0) {
                echo '<p>Esse paciente não tem esse horário disponível.</p>';
            } else if (is_array($nurseCheck) && sizeof($nurseCheck) > 0) {
                echo '<p>Esse enfermeiro já realizará um exame nesse horário.</p>';
            } else if ($_POST["paciente"] == $_POST["enfermeiro"]) {
                echo '<p>O paciente e enfermeiro não podem ser a mesma pessoa.</p>';
            } else {
                echo var_export($patientCheck) . '-----' . var_export($nurseCheck);
                // $db->exec('INSERT INTO Agendamento VALUES (0,0,0,0,0)');
                //id INTEGER NOT NULL,
                // exame_id INTEGER NOT NULL,
                // horario TIME NOT NULL,
                // paciente_id INTEGER NOT NULL,
                // enfermeiro_id INTEGER NOT NULL,
                // PRIMARY KEY (id, paciente_id),
            }
        }
        ?>
        <form class="boundBox" action="./agendarRedirect.php" method="POST">
            <label for="tipoExame">Tipo de Exame:</label>
            <select name="tipoExame" id="tipoExame">
                <?php
                $db = new SQLite3('../db/userData.db');
                $examData = $db->query('SELECT id, nome FROM DadosExames;');
                while ($row = $examData->fetchArray(SQLITE3_ASSOC)) {
                    echo '<option value="' . $row["id"] . '">' . $row["nome"] . '</option>';
                }
                unset($row);
                ?>
            </select>
            <label for="datahorario">Data e horário do Exame:</label>
            <input type="datetime-local" name="datahorario" id="datahorario">

            <button type="submit">Agendar</button>
        </form>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>