<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica Hsucesso</title>
    <link rel="stylesheet" href="../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="../node_modules/milligram/dist/milligram.css">
    <link rel="stylesheet" href="../css/geral.css">
    <link rel="stylesheet" href="../css/criaConta.css">
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <?php
        if (!empty($_POST)) {
            $date1 = new DateTime(date('d/m/Y'));
            $date2 = new DateTime($_POST["dataNascimento"]);
            $idade = $date1->diff($date2)->format("%y");
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo '<p><b>Formato de email inválido.</b></p>';
            } else if (!($_POST["senha"] == $_POST["senha2"])) {
                echo '<p><b>As senhas não coincidem.</b></p>';
            } else if ($idade < 18) {
                echo '<p><b>Você precisa ter pelo menos 18 anos para criar uma conta.</b></p>';
            } else {
                $username = trim($_POST["user"]);
                $email = trim($_POST["email"]);
                $password = trim($_POST["senha"]);
                $password = md5(trim($_POST["senha"]));
                $nomeReal = trim($_POST["nomeReal"]);
                $cpf = $_POST["cpf"];
                $db = new SQLite3('../db/userData.db');
                $lookUp = implode($db->querySingle('SELECT * FROM Users WHERE username = "' . $username . '" OR email = "' . $email . '" OR nomeReal = "' . $nomeReal . '" OR cpf = "' . $cpf . '";', true));
                if (str_contains($lookUp, $username)) {
                    echo "<p><b>Esse nome de usuário já é utilizado por outra pessoa.</b></p>";
                } else if (str_contains($lookUp, $nomeReal) || str_contains($lookUp, $nomeReal)) {
                    echo "<p><b>Essa pessoa já tem uma conta cadastrada.</b></p>";
                } else if (str_contains($lookUp, $email)) {
                    echo "<p><b>Esse email já é utilizado por outra pessoa.</b></p>";
                } else {
                    $db->exec('INSERT INTO Users (username, email, password, nomeReal, cpf, idade) VALUES ("' . $username . '", "' . $email . '", "' . $password . '", "' . $nomeReal . '", "' . $cpf . '", ' . $idade . ')');
                    header('Location: ./login.php');
                }
            }
        }
        ?>
        <h2>Crie sua conta:</h2>
        <form id="signupContainer" class="boundBox" method="POST" action="">
            <label for="user">
                <b>Usuário:</b>
                <input type="text" placeholder="Nome de usuário" name="user" maxlength="15" required>
            </label>

            <label for="nomeReal">
                <b>Nome completo:</b>
                <input type="text" placeholder="Nome completo" name="nomeReal" maxlength="50" required>
            </label>

            <label for="cpf">
                <b>CPF:</b>
                <input type="text" placeholder="CPF" name="cpf" minlength="14" maxlength="14" oninput="
                if(this['value'].length > 3 && this['value'][3] != '.') {
                    this['value'] = this['value'].slice(0,3) + '.' + this['value'].slice(3);
                }
                if(this['value'].length > 7 && this['value'][7] != '.') {
                    this['value'] = this['value'].slice(0,7) + '.' + this['value'].slice(7);
                }
                if(this['value'].length > 11 && this['value'][11] != '-') {
                    this['value'] = this['value'].slice(0,11) + '-' + this['value'].slice(11);
                }" onkeypress="
                if(isNaN(parseInt(event.key))) {
                    event.preventDefault();
                }
                " required>
            </label>

            <label for="email">
                <b>Email:</b>
                <input type="text" placeholder="Email" name="email" maxlength="30" required>
            </label>

            <label for="senha">
                <b>Senha:</b>
                <input type="password" placeholder="Senha" name="senha" maxlength="20" required>
            </label>

            <label for="senha2">
                <b>Repita a senha:</b>
                <input type="password" placeholder="Repita a senha" name="senha2" maxlength="20" required>
            </label>

            <label for="dataNascimento">
                <b>Data de nasimento</b>
                <input type="date" name="dataNascimento" required>
            </label>

            <button type="submit">Criar Conta</button>
            <a href="./login.php">Já tenho uma conta</a>
        </form>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>