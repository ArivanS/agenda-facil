<?php

require_once "includes/topo.php";

if (!isset($_SESSION['servico'])) {

    header('Location: index.php');
    exit;
}

$erro = '';

$horarios = [
    '09:00' => false,
    '10:30' => true,
    '11:30' => true,
    '13:00' => true,
    '14:00' => false,
    '15:30' => true,
    '17:00' => true,
    '18:30' => true
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST['data'] ?? '';
    $horario = $_POST['horario'] ?? '';

    if (empty($data)) {

        $erro = 'Escolha uma data.';

    } elseif (empty($horario)) {

        $erro = 'Escolha um horário.';

    } elseif (!isset($horarios[$horario])) {

        $erro = 'Horário inválido.';

    } elseif ($horarios[$horario] === false) {

        $erro = 'Esse horário está indisponível. Escolha outro horário.';

    } else {

        $_SESSION['data'] = $data;
        $_SESSION['horario'] = $horario;

        header('Location: confirmacao.php');
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

    <title>Data e horário</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>

<div class="tela">

    <div class="titulo-tela">
        ETAPA 2 DE 4
    </div>

    <div class="celular">

        <div class="cabecalho">
            Data e horário
        </div>

        <?php if (!empty($erro)): ?>

            <div class="mensagem-erro">
                <?= htmlspecialchars($erro) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="grupo">

                <div class="grupo-titulo">
                    Escolha uma data
                </div>

                <input
                    type="date"
                    name="data"
                    min="<?= date('Y-m-d') ?>"
                    value="<?= htmlspecialchars($_POST['data'] ?? '') ?>"
                    required
                >

            </div>

            <div class="grupo">

                <div class="grupo-titulo">
                    Horários disponíveis
                </div>

                <div class="horarios">

                    <?php foreach ($horarios as $hora => $disponivel): ?>

                        <label class="horario">

                            <input
                                type="radio"
                                name="horario"
                                value="<?= htmlspecialchars($hora) ?>"
                                <?= !$disponivel ? 'disabled' : '' ?>
                                <?= (
                                    ($_POST['horario'] ?? '') === $hora
                                    && $disponivel
                                ) ? 'checked' : '' ?>
                                <?= (
                                    $disponivel &&
                                    empty($_POST['horario'])
                                ) ? 'required' : '' ?>
                            >

                            <span class="<?= !$disponivel ? 'indisponivel' : '' ?>">

                                <?= htmlspecialchars($hora) ?>

                                <?php if (!$disponivel): ?>
                                    <small>Indisponível</small>
                                <?php endif; ?>

                            </span>

                        </label>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="botoes">

                <a
                    href="index.php"
                    class="btn btn-voltar"
                >
                    Voltar
                </a>

                <button
                    type="submit"
                    class="btn"
                >
                    Continuar
                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>