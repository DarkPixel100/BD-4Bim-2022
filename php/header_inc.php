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
                <a id="login" href="/php/login.php">LOGIN</a>
            <?php
            else :
                echo '
                <h3>' . $_SESSION["currentUserName"] . '</h3>
                <a id="logout" href="/php/logout.php?r=' . basename($_SERVER["PHP_SELF"], ".php") . '" )>LOGOUT</a>
                ';
            endif; ?>
            <a id="contatos" href="/php/contatos.php">CONTATOS</a>
        </div>
    </div>
    <nav>
        <a href="/php/cronograma.php">CRONOGRAMA</a>
        <a href="/php/resultados.php">RESULTADOS</a>
        <a href="/php/convenio.php">CONVÊNIOS</a>
    </nav>
</div>
