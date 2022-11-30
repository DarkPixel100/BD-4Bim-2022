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
</head>

<body>
    <?php include './header_inc.php'; ?>
    <div id="wrapper">
        <div id="loginContainer">
            <label for="user"><b>Usuário:</b></label>
            <input type="text" placeholder="Digite o usuário" name="user" required>

            <label for="senha"><b>Senha:</b></label>
            <input type="password" placeholder="Digite a senha" name="senha" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember">  Lembre-me</input>
            </label>
        </div>
        <div id="footer">
            <h3> Clínica Hsucesso - Copyright © 2022 - Todos os direitos reservados </h3>
        </div>
    </div>
</body>

</html>