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

            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" required placeholder="Digite seu nome">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" required placeholder="seu@email.com">
            </div>

            <div class="form-group">
                <label for="telefone">Celular</label>
                <input type="tel" name="telefone" required placeholder="(00) 00000-0000">
            </div>

            <div class="form-group">
                <label for="senha">Crie uma Senha</label>
                <input type="password" name="senha" required placeholder="Mínimo 6 caracteres">
            </div>

            <button type="submit" class="btn-cta" style="width: 100%; border: none; cursor: pointer;">CONFIRMAR MATRÍCULA</button>
        </form>
    </div>

</body>
</html>