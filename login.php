<?php

session_start();

$erro = '';

$usuarioCorreto = 'admin';
$senhaCorreta = '123456';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($usuario) || empty($senha)) {

        $erro = 'Preencha o usuário e a senha.';

    } elseif (
        $usuario === $usuarioCorreto &&
        $senha === $senhaCorreta
    ) {

        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;

        header('Location: index.php');
        exit;

    } else {

        $erro = 'Usuário ou senha incorretos.';
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Agendamento</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>

<div class="tela">

    <div class="titulo-tela">
        ACESSO AO SISTEMA
    </div>

    <div class="celular">

        <div class="cabecalho">
            Acesso
        </div>

        <div class="grupo">

            <div class="grupo-titulo">
                Bem-vindo!
            </div>

            <p class="descricao">
                Entre com seus dados para acessar
                o sistema de agendamento.
            </p>

        </div>

        <?php if (!empty($erro)): ?>

            <div class="mensagem-erro">
                <?= htmlspecialchars($erro) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="grupo">

                <div class="grupo-titulo">
                    Usuário
                </div>

                <input
                    type="text"
                    name="usuario"
                    class="input-texto"
                    placeholder="Digite seu usuário"
                    value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>"
                    autocomplete="username"
                    required
                >

            </div>

            <div class="grupo">

                <div class="grupo-titulo">
                    Senha
                </div>

                <input
                    type="password"
                    name="senha"
                    class="input-texto"
                    placeholder="Digite sua senha"
                    autocomplete="current-password"
                    required
                >

            </div>

            <button
                type="submit"
                class="btn"
            >
                Entrar
            </button>

        </form>

        <div class="rodape-login">
            Sistema de Agendamento
        </div>

    </div>

</div>

</body>

</html>
