<?php

require_once "includes/topo.php";

$arquivo = __DIR__ . '/dados/agendamentos.json';

$agendamentos = [];

if (file_exists($arquivo)) {

    $conteudo = file_get_contents($arquivo);

    $agendamentos = json_decode(
        $conteudo,
        true
    );

    if (!is_array($agendamentos)) {

        $agendamentos = [];
    }
}

$agendamentos = array_reverse($agendamentos);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Agendamentos confirmados</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>

<div class="tela">

    <div class="titulo-tela">
        AGENDAMENTOS
    </div>

    <div class="celular">

        <div class="cabecalho">
            Agendamentos confirmados
        </div>

        <?php if (empty($agendamentos)): ?>

            <div class="resultado resultado-vazio">

                <div class="check check-vazio">
                    !
                </div>

                <h2>
                    Nenhum agendamento
                </h2>

                <p>
                    Ainda não existem agendamentos
                    confirmados no sistema.
                </p>

            </div>

        <?php else: ?>

            <div class="grupo">

                <div class="grupo-titulo">

                    <?= count($agendamentos) ?>

                    agendamento(s) confirmado(s)

                </div>

                <div class="lista-agendamentos">

                    <?php foreach ($agendamentos as $agendamento): ?>

                        <div class="agendamento-card">

                            <div class="agendamento-topo">

                                <strong>
                                    <?= htmlspecialchars(
                                        $agendamento['servico'] ?? ''
                                    ) ?>
                                </strong>

                                <span class="status-confirmado">
                                    Confirmado
                                </span>

                            </div>

                            <div class="agendamento-info">

                                <div>

                                    <small>
                                        Cliente
                                    </small>

                                    <strong>
                                        <?= htmlspecialchars(
                                            $agendamento['nome'] ?? ''
                                        ) ?>
                                    </strong>

                                </div>

                                <div>

                                    <small>
                                        Data
                                    </small>

                                    <strong>
                                        <?= !empty($agendamento['data'])
                                            ? date(
                                                'd/m/Y',
                                                strtotime(
                                                    $agendamento['data']
                                                )
                                            )
                                            : '-'
                                        ?>
                                    </strong>

                                </div>

                                <div>

                                    <small>
                                        Horário
                                    </small>

                                    <strong>
                                        <?= htmlspecialchars(
                                            $agendamento['horario'] ?? ''
                                        ) ?>
                                    </strong>

                                </div>

                            </div>

                            <div class="agendamento-protocolo">

                                Protocolo:

                                <strong>
                                    <?= htmlspecialchars(
                                        $agendamento['protocolo'] ?? ''
                                    ) ?>
                                </strong>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endif; ?>

        <div class="botoes">

            <a
                href="index.php"
                class="btn btn-voltar"
            >
                Novo agendamento
            </a>

            <a
                href="logout.php"
                class="btn"
            >
                Sair
            </a>

        </div>

    </div>

</div>

</body>

</html>