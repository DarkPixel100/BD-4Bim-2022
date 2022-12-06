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
            <?php
            if (!isset($_SESSION["startTime"])) header("Location: ./login.php?r=Resultados");
            ?>
            <h2>Resultados:</h2>
        </div>
    </div>
    <?php
    include './footer_inc.php';
    ?>
</body>

</html>
