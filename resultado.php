<?php

require_once "includes/topo.php";

if (
    !isset($_SESSION['servico']) ||
    !isset($_SESSION['data']) ||
    !isset($_SESSION['horario']) ||
    !isset($_SESSION['nome']) ||
    !isset($_SESSION['protocolo'])
) {

    header('Location: index.php');
    exit;
}

$servico = $_SESSION['servico'];
$data = $_SESSION['data'];
$horario = $_SESSION['horario'];
$nome = $_SESSION['nome'];
$protocolo = $_SESSION['protocolo'];

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Agendamento confirmado</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>

<div class="tela">

    <div class="titulo-tela">
        ETAPA 4 DE 4
    </div>

    <div class="celular">

        <div class="cabecalho">
            Agendamento confirmado
        </div>

        <div class="resultado">

            <div class="check">
                ✓
            </div>

            <h2>
                Tudo certo!
            </h2>

            <p>
                Olá,
                <strong>
                    <?= htmlspecialchars($nome) ?>
                </strong>!
            </p>

            <p>
                Serviço:
                <strong>
                    <?= htmlspecialchars($servico) ?>
                </strong>
            </p>

            <p>
                Data:
                <strong>
                    <?= date(
                        'd/m/Y',
                        strtotime($data)
                    ) ?>
                </strong>
            </p>

            <p>
                Horário:
                <strong>
                    <?= htmlspecialchars($horario) ?>
                </strong>
            </p>

            <div class="protocolo">
                Protocolo:
                <?= htmlspecialchars($protocolo) ?>
            </div>

            <a
                href="index.php"
                class="btn"
            >
                Novo agendamento
            </a>

            <a
                href="agendamentos.php"
                class="btn btn-ver-agendamentos"
            >
                Ver agendamentos
            </a>

            <a
                href="logout.php"
                class="link-sair"
            >
                Sair do sistema
            </a>

        </div>

    </div>

</div>

</body>

</html>