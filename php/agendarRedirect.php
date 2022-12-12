<form action="./agendar.php" method="POST">
    <?php
    if (!isset($_SESSION["currentUserID"])) session_start();
    $db = new SQLite3('../db/userData.db');
    echo '
    <select name="tipoExame" id="tipoExame"><option value="' . $_POST["tipoExame"] . '"></select>
    <input type="datetime-local" name="datahorario" id="datahorario" value="' . $_POST["datahorario"] . '">
    ';
    ?>
    <select name="paciente" id="paciente">
        <?php
        echo '<option value="' . $_SESSION["currentUserID"] . '"></option>';
        ?>
    </select>

    <select name="enfermeiro" id="enfermeiro">
        <?php
        $nurseCheck = $db->querySingle('SELECT Funcionarios.id, Users.nomeReal FROM Funcionarios JOIN Users ON Funcionarios.id = Users.id AND Funcionarios.type = "enfermeiro" LEFT JOIN Agendamento ON Funcionarios.id = Agendamento.enfermeiro_id EXCEPT SELECT Funcionarios.id, Users.nomeReal FROM Agendamento LEFT JOIN Funcionarios ON Funcionarios.id = Agendamento.enfermeiro_id AND Agendamento.horario = "' . $_POST["datahorario"] . '" JOIN Users ON Funcionarios.id = Users.id AND Funcionarios.type = "enfermeiro";', true);
        if (is_array($nurseCheck) && sizeof($nurseCheck) > 0) {
            echo '<option value="' . $nurseCheck["id"] . '"></option>';
        } else {
            echo '<option value="-1"></option>';
        }
        $db->close();
        ?>
    </select>
</form>
<script src="../js/submit.js"></script>