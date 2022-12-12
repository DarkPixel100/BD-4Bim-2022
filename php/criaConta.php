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
        <h2>Crie sua conta:</h2>
        <?php
        if (!empty($_POST)) {
            $birthDate = new DateTime($_POST["dataNascimento"]);
            $currentDate = new DateTime(date('Y-m-d'));
            $idade = $currentDate->diff($birthDate)->format("%y");
            // 
            $birthDateUnix = strtotime($_POST["dataNascimento"]);
            $currentDateUnix = strtotime(date('Y-m-d'));
            $idadeUnix = $currentDateUnix - $birthDateUnix;
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo '<p>Formato de email inválido.</p>';
            } else if (!($_POST["senha"] == $_POST["senha2"])) {
                echo '<p>As senhas não coincidem.</p>';
            } else if ($idadeUnix < 0) {
                echo '<p>A idade inserida é inválida.</p>';
            } else if ($idade < 18) {
                echo '<p>Você precisa ter pelo menos 18 anos para criar uma conta.</p>';
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
                    echo "<p>Esse nome de usuário já é utilizado por outra pessoa.</p>";
                } else if (str_contains($lookUp, $nomeReal) || str_contains($lookUp, $cpf)) {
                    echo "<p>Essa pessoa já tem uma conta cadastrada.</p>";
                } else if (str_contains($lookUp, $email)) {
                    echo "<p>Esse email já é utilizado por outra pessoa.</p>";
                } else {
                    $db->exec('INSERT INTO Users (username, email, password, nomeReal, cpf, idade) VALUES ("' . $username . '", "' . $email . '", "' . $password . '", "' . $nomeReal . '", "' . $cpf . '", ' . $idade . ')');
                    $done = true;
                }
            }
        }
        ?>
        <?php if ($done) : ?>
            <h4>Conta criada com sucesso!</h4>
        <?php else : ?>
            <form id="signupContainer" class="boundBox" action="" method="POST">
                <label for="user">
                    Usuário:
                    <input type="text" placeholder="Nome de usuário" name="user" maxlength="15" required>
                </label>

                <label for="nomeReal">
                    Nome completo:
                    <input type="text" placeholder="Nome completo" name="nomeReal" maxlength="50" oninput="
                if (this['value'].length > 0) {
                    this['value'] = this['value'][0].toUpperCase() + this['value'].slice(1,this['value'].length);
                }   
                " required>
                </label>

                <label for="cpf">
                    CPF:
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
                    Email:
                    <input type="text" placeholder="Email" name="email" maxlength="30" required>
                </label>

                <label for="senha">
                    Senha:
                    <input type="password" placeholder="Senha" name="senha" maxlength="20" required>
                </label>

                <label for="senha2">
                    Repita a senha:
                    <input type="password" placeholder="Repita a senha" name="senha2" maxlength="20" required>
                </label>

                <label for="dataNascimento">
                    Data de nasimento
                    <input type="date" name="dataNascimento" required>
                </label>

                <button type="submit">Criar Conta</button>
                <a href="./login.php">Já tenho uma conta</a>
            </form>
        <?php
            $db->close();
        endif; ?>
    </div>
    <?php
    include './footer_inc.php';
    exit();
    ?>
</body>

</html>