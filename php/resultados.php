<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <div id="resultados">
            <h2>Resultados:</h2>
            <?php
            if (!isset($_SESSION["startTime"])) header('Location: ./login.php?r=Resultados');
            ?>
            <?php
            if ($_SESSION["currentUserType"] == '' && filetype('../resultados/resultados' . $_SESSION['currentUserID'] . '.pdf')) : ?>
                <span>Para acessar os resultados de exames, clique no botão abaixo:</span>
                <br>
                <br>
                <span>Clique aqui para baixar os resultados dos exames:</span>
                <?php
                echo '<a href="../resultados/resultados' . $_SESSION['currentUserID'] . '.pdf" download="Resultados' . $_SESSION['currentUserName'] . '.pdf"><button type="button">Download</button></a>';
                ?>
            <?php elseif ($_SESSION["currentUserType"] == '') : ?>
                <span>Seus resultados ainda não estão prontos</span>
            <?php else : ?>
                <div class="boundBox">
                    <span>Faça upload dos resultados:</span>
                    <?php
                    $db = new SQLite3('../db/userData.db');
                    if (!empty($_POST)) {
                        $target_file = '../resultados/resultados' . $_POST["pacientes"] . '.pdf';
                        move_uploaded_file($_FILES["resultado"]["tmp_name"], $target_file);
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="resultado">Arquivo (.pdf):</label>
                        <input type="file" name="resultado" id="resultado">
                        <label for="pacientes">Paciente:</label>
                        <select name="pacientes" id="pacientes">
                            <?php
                            $patients = $db->query('SELECT id, nomeReal FROM Users');
                            while ($row = $patients->fetchArray(SQLITE3_ASSOC)) {
                                echo '<option value="' . $row["id"] . '">' . $row["nomeReal"] . '</option>';
                            }
                            ?>
                        </select>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    include './footer_inc.php';
    ?>
</body>

</html>