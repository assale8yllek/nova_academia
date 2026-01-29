<?php
session_start();
require_once 'config/database.php';

if (isset($_SESSION['usuario_id'])) { header("Location: painel.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: painel.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="animated-bg"> <div class="form-container">
        <a href="index.php" style="color:#666; text-decoration:none; font-size:0.9rem;">&larr; Voltar</a>
        
        <div style="text-align: center; margin: 20px 0;">
            <h2 style="font-size: 2rem; color: #fff;">BEM-VINDO</h2>
            <p style="color: var(--primary); letter-spacing: 2px;">ACADEMIA PRO</p>
        </div>

        <?php if(isset($erro)): ?>
            <div class="msg error"><i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?></div>
        <?php endif; ?>
        
        <form method="POST" autocomplete="off">
            <label>Seu E-mail</label>
            <input type="email" name="email" required placeholder="exemplo@email.com" autocomplete="off">
            
            <label>Sua Senha</label>
            <div class="password-wrapper">
                <input type="password" name="senha" id="senhaInput" required placeholder="Digite sua senha">
                <i class="fas fa-eye toggle-password" onclick="togglePassword('senhaInput', this)"></i>
            </div>

            <button type="submit" class="btn-cta" style="width:100%; margin-top:20px;">ACESSAR SISTEMA</button>
        </form>

        <p style="text-align:center; margin-top:20px; color:#666;">
            Não tem cadastro? <a href="cadastro.php" style="color:var(--primary);">Criar conta</a>
        </p>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>