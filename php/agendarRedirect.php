<formaction=". /agendar.php" method="POST">
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
    <select name="paciente" id="paciente" hidden>
        <?php
        while ($row = $patientData->fetchArray(SQLITE3_ASSOC)) {
            echo '<option value="' . $_SESSION["currentUserId"] . '"></option>';
        }
        ?>
    </select>
    <select name="enfermeiro" id="enfermeiro" hidden>
        <?php
        $nurseCheck = $db->querySingle('SELECT Funcionarios.id FROM Agendamento LEFT JOIN Funcionarios ON Funcionarios.id = ' . $_POST["enfermeiro"] . ' AND Funcionarios.id = Agendamento.enfermeiro_id AND Agendamento.horario = "' . $_POST["datahorario"] . '" JOIN Users ON Funcionarios.id = Users.id AND Funcionarios.type = "enfermeiro";', true);
        $nurseData = $db->query('SELECT Funcionarios.id, Users.nomeReal FROM Funcionarios LEFT JOIN Users WHERE Funcionarios.id = Users.id AND Funcionarios.type = "enfermeiro";');
        while ($row = $nurseData->fetchArray(SQLITE3_ASSOC)) {
            echo '<option value="' . $row["id"] . '">' . $row["nomeReal"] . '</option>';
        }
        unset($row);
        $db->close();
        ?>
    </select>
    </form>