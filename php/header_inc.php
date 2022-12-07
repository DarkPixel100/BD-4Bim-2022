<?php
if (!isset($_SESSION["currentUserID"])) session_start();
if (isset($_SESSION["lifeTime"]) && (time() - $_SESSION["startTime"] > $_SESSION["lifeTime"])) {
    session_destroy();
}
?>
<div id="header">
    <div id="box">
        <a href="./index.php"><img src="../img/Clinica Hsucesso-Logo.svg" alt="Logo_Hsucesso"></a>
        <h1>Clínica Hsucesso</h1>
        <div id="abas">
            <?php
            if (!isset($_SESSION["loggedIn"])) :
            ?>
                <a id="login" href="/BD-4Bim-2022/php/login.php">LOGIN</a>
            <?php
            else :
                echo '
                <h3>' . $_SESSION["currentUserName"] . '</h3>
                <a id="logout" href="/BD-4Bim-2022/php/logout.php?r=' . basename($_SERVER["PHP_SELF"], ".php") . '" )>LOGOUT</a>
                ';
            endif; ?>
            <a id="contatos" href="/BD-4Bim-2022/php/contatos.php">CONTATOS</a>
        </div>
    </div>
    <nav>
        <a href="/BD-4Bim-2022/php/cronograma.php">CRONOGRAMA</a>
        <a href="/BD-4Bim-2022/php/resultados.php">RESULTADOS</a>
        <a href="/BD-4Bim-2022/php/convenio.php">CONVÊNIOS</a>
    </nav>
</div>