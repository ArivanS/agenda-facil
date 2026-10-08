<?php

require_once "includes/topo.php";



if (
    !isset($_SESSION['servico']) ||
    !isset($_SESSION['data']) ||
    !isset($_SESSION['horario'])
) {

    header('Location: index.php');

    exit;
}


$servico = $_SESSION['servico'];

$data = $_SESSION['data'];

$horario = $_SESSION['horario'];


$erro = '';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');


    

    if (empty($nome)) {

        $erro = 'Digite seu nome para continuar.';

    } else {


       
        $protocolo =
            'AG' .
            strtoupper(
                substr(
                    md5(uniqid()),
                    0,
                    6
                )
            );


        

        $novoAgendamento = [

            'protocolo' => $protocolo,

            'nome' => $nome,

            'servico' => $servico,

            'data' => $data,

            'horario' => $horario,

            'criado_em' => date('d/m/Y H:i:s')

        ];



        $arquivo = __DIR__ . '/dados/agendamentos.json';


        
        if (!file_exists($arquivo)) {

            file_put_contents(
                $arquivo,
                json_encode(
                    [],
                    JSON_PRETTY_PRINT |
                    JSON_UNESCAPED_UNICODE
                )
            );
        }


      

        $conteudo = file_get_contents($arquivo);

        $agendamentos = json_decode(
            $conteudo,
            true
        );


        if (!is_array($agendamentos)) {

            $agendamentos = [];
        }



        $agendamentos[] = $novoAgendamento;


        
        file_put_contents(
            $arquivo,
            json_encode(
                $agendamentos,
                JSON_PRETTY_PRINT |
                JSON_UNESCAPED_UNICODE
            )
        );


      

        $_SESSION['nome'] = $nome;

        $_SESSION['protocolo'] = $protocolo;



        header('Location: resultado.php');

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

    <title>Revisar agendamento</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>


<div class="tela">

    <div class="titulo-tela">
        ETAPA 3 DE 4
    </div>


    <div class="celular">


        <div class="cabecalho">
            Revisar agendamento
        </div>


        <?php if (!empty($erro)): ?>

            <div class="mensagem-erro">

                <?= htmlspecialchars($erro) ?>

            </div>

        <?php endif; ?>


        <div class="grupo">

            <div class="grupo-titulo">
                Confira seus dados
            </div>


            <div class="revisao">


                <div class="linha-info">

                    <span>
                        Serviço
                    </span>

                    <span>
                        <?= htmlspecialchars($servico) ?>
                    </span>

                </div>


                <div class="linha-info">

                    <span>
                        Data
                    </span>

                    <span>
                        <?= date(
                            'd/m/Y',
                            strtotime($data)
                        ) ?>
                    </span>

                </div>


                <div class="linha-info">

                    <span>
                        Horário
                    </span>

                    <span>
                        <?= htmlspecialchars($horario) ?>
                    </span>

                </div>


            </div>

        </div>


        <form method="POST">


            <div class="grupo">

                <div class="grupo-titulo">
                    Seu nome
                </div>


                <input
                    type="text"
                    name="nome"
                    class="input-texto"
                    placeholder="Digite seu nome"
                    value="<?= htmlspecialchars(
                        $_POST['nome'] ?? ''
                    ) ?>"
                    required
                >

            </div>


            <div class="botoes">


                <a
                    href="data-horario.php"
                    class="btn btn-voltar"
                >
                    Voltar
                </a>


                <button
                    type="submit"
                    class="btn"
                >
                    Confirmar
                </button>


            </div>


        </form>


    </div>

</div>


</body>

</html>