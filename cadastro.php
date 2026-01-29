<?php
require_once 'config/database.php';

$msg = "";
$plano_id = $_GET['plano'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];
    $tel = $_POST['telefone'];
    $plano = $_POST['plano_id'];

    if ($nome && $email && $senha) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO alunos (nome, email, senha, telefone, plano_id) VALUES (?,?,?,?,?)");
            $stmt->execute([$nome, $email, $senha_hash, $tel, $plano]);
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location='login.php';</script>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $msg = "Este e-mail já possui cadastro.";
            } else {
                $msg = "Erro ao processar cadastro.";
            }
        }
    } else {
        $msg = "Por favor, preencha todos os campos.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="animated-bg">

    <div class="form-container">
        <a href="index.php" style="color:#666; text-decoration:none; font-size:0.9rem;">&larr; Cancelar</a>
        
        <div style="text-align: center; margin: 20px 0;">
            <h2 style="font-size: 2rem; color: #fff;">CRIAR CONTA</h2>
            <p style="color: #888;">Junte-se ao time <span style="color:var(--primary)">PRO</span></p>
        </div>

        <?php if($msg): ?>
            <div class="msg error"><i class="fas fa-exclamation-triangle"></i> <?php echo $msg; ?></div>
        <?php endif; ?>
        
        <form method="POST" autocomplete="off">
            <input type="hidden" name="plano_id" value="<?php echo $plano_id; ?>">

            <label>Nome Completo</label>
            <input type="text" name="nome" required autocomplete="off">

            <label>E-mail</label>
            <input type="email" name="email" required autocomplete="new-password">

            <label>Celular</label>
            <input type="tel" name="telefone" required placeholder="(00) 00000-0000" autocomplete="off">

            <label>Crie uma Senha</label>
            <div class="password-wrapper">
                <input type="password" name="senha" id="senhaCad" required autocomplete="new-password">
                <i class="fas fa-eye toggle-password" onclick="togglePassword('senhaCad', this)"></i>
            </div>

            <button type="submit" class="btn-cta" style="width:100%; margin-top:20px;">FINALIZAR MATRÍCULA</button>
        </form>

        <p style="text-align:center; margin-top:20px; color:#666; font-size:0.9rem;">
            Ao clicar em finalizar, você concorda com nossos termos de uso.
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