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
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <div id="inicio">
            <h1>Atendimento</h1>
            <p>
                HORÁRIO DE COLETAS:<br>
                -Unidade Matriz - Rio Grande: 07h às 17:30h - sáb. 07h às 11:30h.<br>
                -Unidade Filial - São José do Norte: Seg à Sex das 07h às 10h (não abre aos sábados).
            </p>
        </div>
        <div id="caixas">
            <a href="./resultados.php">
                <div>
                    <h2>Resultados</h2>
                    <p>
                        Você será informado via SMS, quando os resultados dos seus exames já estiverem disponíveis em nosso site.
                    </p>
                </div>
            </a>
            <?php
            if ($_SESSION["currentUserType"] == 'atendente' || $_SESSION["currentUserType"] == 'enfermeiro') :
            ?>
                <a href="./agendarStaff.php">
                <?php else : ?>
                    <a href="./agendar.php">
                    <?php endif; ?>
                    <div>
                        <h2>Agendamento</h2>
                        <p>
                            Agende sua consulta de maneira on-line.
                        </p>
                    </div>
                    </a>
                    <a href="./exames.php">
                        <div>
                            <h2>Exames</h2>
                            <p>
                                Veja os tipos de exames que fazemos.
                            </p>
                        </div>
                    </a>
        </div>
        <?php if (!$_SESSION["currentUserType"] == 'enfermeiro') : ?>
            <h2>Sempre perto de você</h2>
            <p>Estamos evoluindo sempre, focados no bem estar dos nossos clientes, buscando proporcionar o carinho e conforto a que todos merecem</p>
            <div id="fotosLocal">
                <div>
                    <img src="../img/matrizRG.png" alt="">
                    <h3>Matriz Rio Grande</h3>
                    <p>A Matriz Rio Grande disponibiliza um amplo local para facilitar ainda mais o atendimento, coleta e retirada de resultados.</p>
                </div>
                <div>
                    <img src="../img/recepcao.png" alt="">
                    <h3>Recepção</h3>
                    <p>Recepção com todo o conforto para melhor atender.</p>
                </div>
                <div>
                    <img src="../img/espacoKids.png" alt="">
                    <h3>Espaço Kids</h3>
                    <p>Espaço personalizado para agradar e entreter as crianças.</p>
                </div>
            </div>
        <?php else : ?>
            <div class="boundBox">
                <h2>Escala de Trabalho:</h2>
                <?php
                $db = new SQLite3('../db/userData.db');
                if (!empty($_POST)) {
                    $db->exec('DELETE FROM Agendamento WHERE id = ' . $_POST["examId"] . ';');
                }
                $results = $db->query('SELECT Agendamento.id, DadosExames.nome, Agendamento.horario, Users.nomeReal FROM Agendamento JOIN Users ON Agendamento.enfermeiro_id = ' . $_SESSION["currentUserID"] . ' AND Users.id = Agendamento.paciente_id JOIN DadosExames ON DadosExames.id = Agendamento.exame_id;');
                $row = $results->fetchArray(SQLITE3_NUM);
                if (is_array($row) && sizeof($row) > 0) {
                    $row[2] = date('d/m/Y / H:i', strtotime($row[2]));
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
                    echo '<p>Sem coletas marcadas.</p>';
                }
                $db->close();
                ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>