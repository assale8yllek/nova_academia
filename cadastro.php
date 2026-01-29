<?php
require_once 'config/database.php';
require_once 'includes/header.php';

$erro = "";
$sucesso = "";

$nome = $email = $telefone = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = htmlspecialchars($_POST['telefone']);
    $senha = $_POST['senha'];
    $plano_id = $_POST['plano_id'];

    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos obrigatórios.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM alunos WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO alunos (nome, email, senha, telefone, plano_id) VALUES (?, ?, ?, ?, ?)";
            try {
                $pdo->prepare($sql)->execute([$nome, $email, $senha_hash, $telefone, $plano_id]);
                $sucesso = "Cadastro realizado! Redirecionando...";
                header("refresh:2;url=login.php");
            } catch (PDOException $e) {
                $erro = "Erro no sistema. Tente novamente.";
            }
        }
    }
}

$plano_selecionado = isset($_GET['plano']) ? $_GET['plano'] : 1;
?>

<div class="container-small">
    <div class="form-box">
        <h2 style="text-align:center; margin-bottom:20px;">Criar Conta</h2>
        
        <?php if($erro): ?> <div class="alert alert-error"><?php echo $erro; ?></div> <?php endif; ?>
        <?php if($sucesso): ?> <div class="alert alert-success"><?php echo $sucesso; ?></div> <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="plano_id" value="<?php echo $plano_selecionado; ?>">
            
            <div class="input-group">
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?php echo $nome; ?>" required>
            </div>
            
            <div class="input-group">
                <label>E-mail</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="input-group">
                <label>Telefone</label>
                <input type="tel" name="telefone" value="<?php echo $telefone; ?>" placeholder="(00) 00000-0000">
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="senha" required>
            </div>

            <button type="submit" class="btn-cta" style="width:100%; border:none; cursor:pointer;">FINALIZAR</button>
        </form>
        <p style="text-align:center; margin-top:15px; font-size:0.9rem; color:#666;">
            Já tem conta? <a href="login.php" style="color:var(--primary-color);">Faça Login</a>
        </p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>