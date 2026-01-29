<?php
session_start();
require_once 'config/database.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM alunos WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        header("Location: painel.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Academia Pro</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>ACADEMIA <span>PRO</span></h1>
        <nav><a href="index.php">Voltar</a></nav>
    </header>

    <div class="container-form">
        <h2 style="text-align: center; margin-bottom: 20px;">Acesso ao Aluno</h2>
        
        <?php if($erro): ?>
            <div class="msg-erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit" class="btn-cta" style="width: 100%; border:none; cursor:pointer;">ENTRAR</button>
        </form>
        <p style="text-align:center; margin-top:15px; color:#aaa;">
            Ainda não tem conta? <a href="cadastro.php?plano=1" style="color:#00ff88;">Cadastre-se</a>
        </p>
    </div>
</body>
</html>