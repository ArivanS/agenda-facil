<?php

require_once "includes/topo.php";

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $servico = $_POST['servico'] ?? '';

    $servicosPermitidos = [
        'Corte de cabelo',
        'Manutenção',
        'Consultoria'
    ];

    if (!in_array($servico, $servicosPermitidos, true)) {

        $erro = 'Selecione um serviço para continuar.';

    } else {

        $_SESSION['servico'] = $servico;

        header('Location: data-horario.php');
        exit;
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

    <title>Escolher serviço</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>

<div class="tela">

    <div class="titulo-tela">
        ETAPA 1 DE 4
    </div>

    <div class="celular">

        <div class="cabecalho">
            Escolha o serviço
        </div>

        <?php if (!empty($erro)): ?>

            <div class="mensagem-erro">
                <?= htmlspecialchars($erro) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="grupo">

                <div class="grupo-titulo">
                    Qual serviço você deseja agendar?
                </div>

                <div class="servicos">

                    <label class="servico">

                        <input
                            type="radio"
                            name="servico"
                            value="Corte de cabelo"
                            required
                        >

                        <div class="servico-box">
                            Corte de cabelo
                        </div>

                    </label>

                    <label class="servico">

                        <input
                            type="radio"
                            name="servico"
                            value="Manutenção"
                        >

                        <div class="servico-box">
                            Manutenção
                        </div>

                    </label>

                    <label class="servico">

                        <input
                            type="radio"
                            name="servico"
                            value="Consultoria"
                        >

                        <div class="servico-box">
                            Consultoria
                        </div>

                    </label>

                </div>

            </div>

            <button
                type="submit"
                class="btn"
            >
                Continuar
            </button>

        </form>

        <a
            href="agendamentos.php"
            class="btn btn-agendamentos"
        >
            Ver agendamentos confirmados
        </a>

        <a
            href="logout.php"
            class="link-sair"
        >
            Sair do sistema
        </a>

    </div>

</div>

</body>

</html>