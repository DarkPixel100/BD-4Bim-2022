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
            <p>HORÁRIO DE COLETAS:<br>Unidade Matriz - Rio Grande: 07hs às 17:30h - sáb. 7hs às 11:30hs<br>Unidade Filial - São José do Norte: Seg a Sex das 07:00 as 10:00 (não abre aos sábados)</p>
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
            <a href="./agendar.php">
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
        <h3>Tabela importada do banco com PHP:</h3>
        <?php
        $db = new SQLite3("../db/hsucesso.db");
        $db->exec("PRAGMA foreign_keys = ON");
        $results = $db->query("SELECT * FROM Teste");
        $db->close();
        ?>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>
