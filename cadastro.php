<?php
require_once 'config/database.php';

$mensagem = "";
$plano_selecionado = isset($_GET['plano']) ? $_GET['plano'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $plano_id = $_POST['plano_id'];

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    try{
        $sql = "INSERT INTO alunos (nome, email, senha, telefone, plano_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$nome, $email, $senha_hash, $telefone, $plano_id]);
        
        $mensagem = "<div class='msg-sucesso'>Matrícula realizada com sucesso! Bem-vindo ao time.</div>";
   
        }catch (PDOException $e) {
            if ($e->getCode() == 23000) {
            $mensagem = "<div class='msg-erro'>Erro: Este e-mail já está cadastrado.</div>";
        } else {
            $mensagem = "<div class='msg-erro'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
        }
        }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Academia Pro</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
        <h1>ACADEMIA <span>PRO</span></h1>
        <nav>
            <a href="index.php">Voltar para Início</a>
        </nav>
    </header>

    <div class="container-form">
        <h2 style="text-align: center; margin-bottom: 20px;">Finalizar Matrícula</h2>

        <?php echo $mensagem; ?>

        <form action="cadastro.php" method="POST">
            <input type="hidden" name="plano_id" value="<?php echo $plano_selecionado; ?>">

            <div class="grid-cards">
            <div class="card-info">
                <h3>Seu Plano Atual</h3>
                <div class="valor"><?php echo $dados_aluno['nome_plano']; ?></div>
                <small>Mensalidade: R$ <?php echo number_format($dados_aluno['preco'], 2, ',', '.'); ?></small>
            </div>

            <div class="card-info">
                <h3>Status da Matrícula</h3>
                <div class="valor" style="color: #00ff88;">ATIVO</div>
                <small>Desde <?php echo date('d/m/Y', strtotime($dados_aluno['data_cadastro'])); ?></small>
            </div>

            <div class="card-info" style="border-left-color: #fff;">
                <h3>Treino de Hoje</h3>
                <div class="valor">Peito e Tríceps</div>
                <button style="margin-top:10px; padding:5px 10px; background:#00ff88; border:none; cursor:pointer;">Ver Ficha</button>
            </div>
        </div>
    </div>
</body>
</html>